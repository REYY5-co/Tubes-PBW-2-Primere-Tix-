<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Showtime;
use App\Models\Schedule;
use Midtrans\Config;
use Midtrans\Snap;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * HALAMAN KURSI
     * WAJIB lewat alur pilih lokasi → tanggal → jam
     */
    public function seats($showtimeId)
    {
        $showtime = Showtime::with(['studio', 'schedule.cinema'])->find($showtimeId);

        if (!$showtime) {
            abort(404, "Showtime tidak ditemukan");
        }

        if (!$showtime->studio || !$showtime->schedule) {
            abort(404, "Studio atau Schedule tidak ditemukan");
        }

        $date = $showtime->schedule->date;
        $datetime = Carbon::parse($date->format('Y-m-d') . ' ' . $showtime->time);

        // ❌ tanggal lewat
        if ($date->isPast() && !$date->isToday()) {
            abort(404);
        }

        // ❌ jam lewat hari ini
        if ($date->isToday() && $datetime->isPast()) {
            abort(404);
        }

        return view('seat', compact('showtime'));
    }

    /**
     * AJAX: ambil jam tayang berdasarkan schedule
     */
    public function getShowtimes($scheduleId)
    {
        $schedule = Schedule::with('showtimes.studio')->find($scheduleId);

        if (!$schedule) {
            return response()->json([]);
        }

        $now = now();

        $showtimes = $schedule->showtimes
            ->sortBy('time')
            ->values()
            ->map(function ($showtime) use ($schedule, $now) {
                if (!$showtime->studio) return null;

                $datetime = Carbon::parse($schedule->date->format('Y-m-d') . ' ' . $showtime->time);
                $showtime->is_locked = $schedule->date->isToday() && $datetime->lt($now);

                return $showtime;
            })
            ->filter()
            ->values();

        return response()->json($showtimes);
    }

    /**
     * Halaman Payment
     */
    public function payment(Request $request)
    {
        $selectedSeats = json_decode($request->input('selected_seats'), true);
        $showtimeId = $request->input('showtime_id');

        $showtime = Showtime::with(['schedule.cinema', 'studio'])->find($showtimeId);

        if (!$showtime) abort(404, "Showtime tidak ditemukan");

        $ticketPrice = 50000; // contoh harga tiket
        $totalAmount = count($selectedSeats) * $ticketPrice;

        $order = [
            'movie' => $showtime->movie->title ?? 'Jumbo',
            'cinema' => $showtime->schedule->cinema->name ?? 'Dummy Cinema',
            'poster' => $showtime->movie->poster ?? 'JUMBO.jpg',
            'date' => $showtime->schedule->date->format('d M Y'),
            'ticket_qty' => count($selectedSeats),
            'price_per_ticket' => $ticketPrice,
            'total_amount' => $totalAmount,
            'seats' => $selectedSeats,
        ];

        // Simpan di session untuk proses Midtrans nanti
        session(['order' => $order]);

        return view('payment', compact('order'));
    }

    /**
     * Process Payment via Midtrans
     */
    public function paymentProcess(Request $request)
    {
        $order = session('order'); // ambil data order dari session
        if (!$order) {
            return response()->json(['error' => 'Order tidak ditemukan'], 404);
        }

        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'User tidak login'], 403);
        }

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => 'TIX'.time(),
                'gross_amount' => $order['total_amount'],
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        session(['order_id' => $params['transaction_details']['order_id']]);

        return response()->json([
            'snap_token' => $snapToken
        ]);
    }

    /**
     * Halaman status pembayaran
     */
    public function paymentStatus(Request $request)
    {
        $orderId = session('order_id') ?? 'N/A';
        $status = $request->input('status') ?? 'PENDING';
        $order = session('order') ?? [];

        return view('payment_status', compact('orderId', 'status', 'order'));
    }

}

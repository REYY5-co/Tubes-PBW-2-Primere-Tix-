<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Showtime;
use App\Models\Schedule;
use App\Models\Transaction;
use Midtrans\Config;
use Midtrans\Snap;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // HALAMAN SEAT
    public function seats($showtimeId)
    {
        $showtime = Showtime::with(['studio', 'schedule.cinema', 'film'])->findOrFail($showtimeId);

        $datetime = Carbon::parse($showtime->schedule->date->format('Y-m-d') . ' ' . $showtime->time);

        if ($showtime->schedule->date->isPast() && !$showtime->schedule->date->isToday()) abort(404);
        if ($showtime->schedule->date->isToday() && $datetime->isPast()) abort(404);

        return view('seat', compact('showtime'));
    }

    // AJAX: GET SHOWTIMES
    public function getShowtimes($scheduleId)
    {
        $schedule = Schedule::with('showtimes.studio')->find($scheduleId);
        if (!$schedule) return response()->json([]);

        $now = now();

        $showtimes = $schedule->showtimes
            ->sortBy('time')
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

    // HALAMAN PAYMENT
    public function payment(Request $request)
    {
        // Reset session lama supaya tidak salah film
        session()->forget(['order', 'showtime_id']);

        $selectedSeats = json_decode($request->selected_seats, true);
        $showtimeId = $request->showtime_id;

        $showtime = Showtime::with(['schedule.cinema', 'studio'])->findOrFail($showtimeId);

        $ticketPrice = 50000;
        $totalAmount = count($selectedSeats) * $ticketPrice;

        $order = [
            'movie' => 'JUMBO', // <-- selalu JUMBO
            'cinema' => $showtime->schedule->cinema->name,
            'studio' => $showtime->studio->name,
            'poster' => 'JUMBO.jpg', // <-- selalu poster JUMBO
            'date' => $showtime->schedule->date->format('d M Y'),
            'time' => $showtime->time,
            'ticket_qty' => count($selectedSeats),
            'price_per_ticket' => $ticketPrice,
            'total_amount' => $totalAmount,
            'seats' => $selectedSeats,
        ];

        session([
            'order' => $order,
            'showtime_id' => $showtimeId
        ]);

        return view('payment', compact('order'));
    }


    // PROSES MIDTRANS
    public function paymentProcess(Request $request)
    {
        $order = session('order');
        $showtimeId = session('showtime_id');

        if (!$order || !$showtimeId) {
            return response()->json(['error' => 'Order tidak valid'], 400);
        }

        $user = Auth::user();
        if (!$user) return response()->json(['error' => 'Unauthorized'], 403);

        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $orderId = 'TIX-' . time();

        $transaction = Transaction::create([
            'user_id' => $user->id,
            'showtime_id' => $showtimeId,
            'order_id' => $orderId,
            'total_price' => $order['total_amount'],
            'status' => 'pending',
            'selected_seats' => json_encode($order['seats']),
            'expired_at' => now()->addWeek(),
        ]);

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $order['total_amount'],
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        session([
            'order_id' => $orderId,
            'transaction_id' => $transaction->id
        ]);

        return response()->json(['snap_token' => $snapToken]);
    }

    // STATUS PEMBAYARAN
    public function paymentStatus(Request $request)
    {
        $orderId = session('order_id');
        $status = $request->status;

        if ($orderId) {
            $transaction = Transaction::where('order_id', $orderId)->first();

            if ($transaction) {
                if ($status === 'success') {
                    $transaction->update([
                        'status' => 'paid',
                        'paid_at' => now()
                    ]);
                } elseif ($status === 'error') {
                    $transaction->update(['status' => 'failed']);
                }
            }
        }

        $order = session('order');

        return view('payment_status', compact('orderId', 'status', 'order'));
    }
}

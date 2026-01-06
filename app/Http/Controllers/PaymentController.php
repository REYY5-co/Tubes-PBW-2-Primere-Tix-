<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Showtime;
use App\Models\Transaction;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey    = config('midtrans.server_key');
        Config::$clientKey    = config('midtrans.client_key');
        Config::$isProduction = false;
        Config::$isSanitized  = true;
        Config::$is3ds        = true;
    }

    /* =========================
        PAGE PAYMENT
    ========================= */
    public function showPaymentPage(Request $request)
    {
        if (!$request->showtime_id || !$request->selected_seats) {
            return redirect()->route('homepage');
        }

        $showtime = Showtime::with(['schedule.cinema', 'film'])
            ->findOrFail($request->showtime_id);

        $seats = json_decode($request->selected_seats, true);

        if (empty($seats)) {
            return redirect()->route('homepage');
        }

        $order = [
            'movie' => 'JUMBO', // sesuai request kamu
            'poster' => 'film/jumbo.jpg',
            'cinema' => $showtime->schedule->cinema->name,
            'date' => Carbon::parse($showtime->schedule->date)->format('d M Y'),
            'time' => Carbon::parse($showtime->time)->format('H.i') . ' WIB',
            'seats' => $seats,
            'ticket_qty' => count($seats),
            'price_per_ticket' => 40000,
            'total_amount' => count($seats) * 40000,
            'showtime_id' => $showtime->id,
        ];

        session([
            'order' => $order,
            'midtrans_order_id' => 'ORDER-' . uniqid()
        ]);

        return view('payment', compact('order'));
    }

    /* =========================
        MIDTRANS PROCESS
    ========================= */
    public function processPayment()
    {
        $order = session('order');

        if (!$order) {
            return response()->json(['message' => 'Order tidak ditemukan'], 400);
        }

        $params = [
            'transaction_details' => [
                'order_id' => session('midtrans_order_id'),
                'gross_amount' => $order['total_amount'],
            ],
            'item_details' => [
                [
                    'id' => 'TICKET-' . $order['showtime_id'],
                    'price' => $order['price_per_ticket'],
                    'quantity' => $order['ticket_qty'],
                    'name' => 'Tiket JUMBO',
                ]
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return response()->json([
            'snap_token' => $snapToken
        ]);
    }

    /* =========================
        FINISH PAYMENT
    ========================= */
    public function paymentFinish(Request $request)
    {
        $order = session('order');

        if (!$order) {
            return redirect()->route('homepage');
        }

        $statusMap = [
            'settlement' => 'paid',
            'capture'    => 'paid',
            'pending'    => 'pending',
            'deny'       => 'failed',
            'expire'     => 'failed',
            'cancel'     => 'failed',
        ];

        $finalStatus = $statusMap[$request->transaction_status] ?? 'pending';

        Transaction::create([
            'user_id' => Auth::id(),
            'showtime_id' => $order['showtime_id'],
            'order_id' => session('midtrans_order_id'),
            'selected_seats' => $order['seats'],
            'total_price' => $order['total_amount'],
            'status' => $finalStatus,
            'paid_at' => $finalStatus === 'paid' ? now() : null,
        ]);

        session()->forget(['order', 'midtrans_order_id']);

        return view('payment_status', [
            'status'  => $finalStatus,
            'order'   => $order,
            'orderId' => session('midtrans_order_id'),
        ]);

    }
}

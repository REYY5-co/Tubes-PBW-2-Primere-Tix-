<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;


class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey    = config('midtrans.server_key');
        Config::$clientKey    = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = true;
        Config::$is3ds        = true;
    }

    public function showPaymentPage()
    {
        $order = [
            'movie' => 'Jumbo',
            'cinema' => 'XXI Studio 3',
            'date' => 'Sabtu, 20 Oktober 2025, 14:30',
            'ticket_qty' => 1,
            'price_per_ticket' => 40000,
            'total_amount' => 40000,
        ];

        return view('payment', compact('order'));
    }

    public function processPayment(Request $request)
    {
        $orderId = 'ORDER-' . time();

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => 40000,
            ],
            'item_details' => [
                [
                    'id' => 'TICKET-E6',
                    'price' => 40000,
                    'quantity' => 1,
                    'name' => 'Tiket E6 Jumbo',
                ]
            ],
            'customer_details' => [
                'first_name' => 'John',
                'email' => 'john.doe@example.com',
                'phone' => '08123456789',
            ],
            'enabled_payments' => [
                'qris', 'permata_va', 'bca_va', 'bri_va', 'bni_va', 'credit_card'
            ],
            'callbacks' => [
                'finish' => route('payment.finish'),
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);

            return response()->json([
                'snap_token' => $snapToken,
                'order_id'   => $orderId
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function paymentFinish(Request $request)
    {
        $status = $request->query('transaction_status');
        $order_id = $request->query('order_id');

        if ($status == 'settlement' || $status == 'capture') {
            return view('payment_status', [
                'status'   => 'success',
                'order_id' => $order_id
            ]);
        }

        return view('payment_status', [
            'status'   => 'pending/failed',
            'order_id' => $order_id
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Jobs\SendOrderConfirmation;
use App\Models\Orders;
use App\Models\Payment;
use Illuminate\Http\Request;
use Razorpay\Api\Api;

class PaymentController extends Controller
{
    public function createOrder(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
        ]);
        $order = Orders::findOrFail($request->order_id);
        $api = new Api(
            config('services.razorpay.key'),
            config('services.razorpay.secret')
        );
        $razorpayOrder = $api->order->create([
            'amount' => $order->total * 100,   // paise conversion
            'currency' => 'INR',
        ]);

        Payment::create([
            'order_id' => $order->id,
            'razorpay_order_id' => $razorpayOrder['id'],
            'amount' => $order->total,
            'status' => 'pending',
        ]);

        SendOrderConfirmation::dispatch($order);
        return response()->json([
            'razorpay_order_id' => $razorpayOrder['id'],
            'amount' => $order->total,
            'key' => config('services.razorpay.key'),
        ]);
    }
}

<?php

namespace App\Jobs;

use App\Models\Orders;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Mail;

class SendOrderConfirmation implements ShouldQueue
{
    use Queueable;

    public function __construct(public Orders $orders)
    {
    }

    public function handle(): void
    {
        Mail::raw(
            "Hi {$this->orders->user->name}, your order #{$this->orders->id} is confirmed. Total: ₹{$this->orders->total}",
            function ($message) {
                $message->to($this->orders->user->email)
                    ->subject('Order Confirmation');
            }
        );

        Log::info("Order confirmation sent to {$this->orders->user->email} for Order #{$this->orders->id}");
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentFactory> */
    use HasFactory;
    // app/Models/Payment.php
    protected $fillable = ['order_id', 'razorpay_order_id', 'razorpay_payment_id', 'status', 'amount'];
}

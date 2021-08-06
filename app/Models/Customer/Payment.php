<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = "payments";

    protected $fillable = ['order_id', 'name', 'email', 'transaction_id', 'payment_mode',
    'payment_channel', 'payment_datetime', 'response_message'];
}

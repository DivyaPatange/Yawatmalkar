<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerInfo extends Model
{
    use HasFactory;

    protected $table = "customer_infos";

    protected $fillable = ['customer_id', 'country', 'fullname', 'address', 'city', 'pin_code'];
}

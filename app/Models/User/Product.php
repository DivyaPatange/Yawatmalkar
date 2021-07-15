<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";

    protected $fillable = ['user_id', 'category_id', 'sub_category_id', 'product_name', 'product_img', 'selling_price', 'cost_price', 'description', 'status'];
}

<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flash extends Model
{
    use HasFactory;

    protected $table = "flashes";

    protected $fillable = ['category_id', 'flash_img', 'status'];
}

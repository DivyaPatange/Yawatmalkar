<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWorkingHour extends Model
{
    use HasFactory;

    protected $table = "user_working_hours";

    protected $fillable = ['user_id', 'from', 'to'];
}

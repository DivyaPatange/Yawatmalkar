<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = "schedules";

    protected $fillable = ['user_id', 'start_time', 'end_time', 'consulting_time', 'max_appointment', 'status', 'category_id', 'sub_category_id'];
}

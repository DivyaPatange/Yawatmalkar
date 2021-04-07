<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorWorkingHour extends Model
{
    use HasFactory;

    protected $table = "doctor_working_hours";

    protected $fillable = ['doctor_id', 'from', 'to'];
}

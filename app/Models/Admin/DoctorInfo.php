<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorInfo extends Model
{
    use HasFactory;

    protected $table = "doctor_infos";

    protected $fillable = ['doctor_id', 'photo', 'signature', 'license', 'bank_passbook', 'agreement', 'joining_date', 'declaration_signed', 'mou_signed', 'youtube_link'];
}

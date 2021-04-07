<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorCertificate extends Model
{
    use HasFactory;

    protected $table = "doctor_certificates";

    protected $fillable = ['doctor_id', 'certificate_name', 'certificate_pdf'];
}

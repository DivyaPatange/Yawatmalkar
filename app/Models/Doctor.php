<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $table = "doctors";

    protected $fillable = ['doctor_name', 'category_id', 'sub_category_id', 'contact_no', 'alt_contact_no',
    'aadhar_no', 'email', 'experience', 'qualification', 'specialization', 'office_address', 'residential_address', 'working_hour',
    'other_profession', 'dob', 'expectation', 'achievements', 'about_urself', 'doctor_id', 'username', 'password', 'password_1'];
}

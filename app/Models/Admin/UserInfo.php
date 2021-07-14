<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;

    protected $table = "user_infos";

    protected $fillable = ['user_id', 'category_id', 'sub_category_id', 'contact_no', 'alt_contact_no',
    'aadhar_no', 'experience', 'qualification', 'specialization', 'office_address', 'residential_address', 'working_hour',
    'other_profession', 'dob', 'expectation', 'achievements', 'about_urself', 'photo', 'signature', 'license', 'bank_passbook',
     'agreement', 'joining_date', 'declaration_signed', 'mou_signed', 'youtube_link', 'busi_year', 'serve_capacity'];
}

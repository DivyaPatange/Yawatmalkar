<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCertificate extends Model
{
    use HasFactory;

    protected $table = "user_certificates";

    protected $fillable = ['user_id', 'certificate_name', 'certificate_pdf'];
}

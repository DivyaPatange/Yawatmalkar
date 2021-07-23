<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";

    protected $fillable = ['category_name', 'status', 'category_img', 'type'];

    public function sub_category(){
        return $this->hasMany('App\Models\Admin\SubCategory','category_id', 'id');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\SubCategory;
use App\Models\Admin\Category;

class DesignController extends Controller
{
    public function getSubcategoryList(Request $request)
    {
        $subCategory = SubCategory::where("category_id", $request->category_id)->where('status', 1)
        ->pluck("sub_category","id");
        return response()->json(['subCategory'=>$subCategory, 'category_id' => $request->category_id]);
    }

    public function getCategoryPage($id)
    {
        $cat = Category::findorfail($id);
        return view('frontEnd.doctors', compact('cat'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\SubCategory;
use App\Models\Admin\Category;
use Redirect;
use App\Models\User\Product;

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
        $subCat = SubCategory::where('category_id', $id)->get();
        return view('frontEnd.doctors', compact('cat', 'subCat'));
    }

    public function getProductServices($id)
    {
        $subCategory = SubCategory::findorfail($id);
        $category = Category::where('id', $subCategory->category_id)->first();
        if(!empty($category))
        {
            if($category->type == "Product")
            {
                $products = Product::where('category_id', $category->id)->where('sub_category_id', $id)->get();
                return view('frontEnd.products', compact('category', 'subCategory', 'products'));
            }
        }
        else{
            return Redirect::back();
        }
    }
}

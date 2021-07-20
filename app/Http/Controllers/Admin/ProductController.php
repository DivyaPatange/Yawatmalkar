<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\Product;
use App\Models\Admin\SubCategory;
use App\Models\User\Item;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::all();
        if(request()->ajax()) 
        {
            return datatables()->of($data)
            ->addColumn('product_img', function($row){
                $imageUrl = asset('ProductImg/'.$row->product_img);
                return '<img src="'.$imageUrl.'" width="120px">';
            })
            ->addColumn('status', function($row){
                if($row->status == "In-Stock")
                {
                    return '<span class="badge badge-success">In-Stock</span>';
                }
                else{
                    return '<span class="badge badge-danger">Out of Stock</span>';
                }
            })
            ->addColumn('sub_category_id', function($row){
                $subCategory = SubCategory::where('id', $row->sub_category_id)->first();
                if(!empty($subCategory))
                {
                    return $subCategory->sub_category;
                }
            })
            ->addColumn('item_id', function($row){
                $item = Item::where('id', $row->item_id)->first();
                if(!empty($item))
                {
                    return $item->item_name;
                }
            })
            ->addColumn('action', 'admin.products.action')
            ->rawColumns(['action','status', 'product_img'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findorfail($id);
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

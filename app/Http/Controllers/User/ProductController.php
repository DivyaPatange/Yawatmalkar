<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\Product;
use Auth;
use App\Models\Admin\SubCategory;
use App\Models\Admin\UserInfo;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::where('user_id', Auth::user()->id)->get();
            // dd($data);
        if(request()->ajax()) 
        {
            return datatables()->of($data)
            ->addColumn('product_img', function($row){
                $imageUrl = asset('ProductImg/'.$row->product_img);
                return '<img src="'.$imageUrl.'" width="200px">';
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
            ->addColumn('action', 'auth.schedule.action')
            ->rawColumns(['action','status', 'product_img'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('auth.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userInfo = UserInfo::where('user_id', Auth::user()->id)->first();
        $subCategory = SubCategory::where('category_id', $userInfo->category_id)->get();
        return view('auth.product.create', compact('subCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userInfo = UserInfo::where('user_id', Auth::user()->id)->first();
        $product = new Product();
        $product->user_id = Auth::user()->id;
        $product->category_id = $userInfo->category_id;
        $product->sub_category_id = $request->category_id;
        $product->product_name = $request->product_name;
        $product->selling_price = $request->selling_price;
        $product->cost_price = $request->cost_price;
        $product->description = $request->desctiption;
        $image = $request->file('product_img');
        if($image != '')
        {
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('ProductImg'), $image_name);
        }
        $product->product_img = $image_name;
        $product->save();
        return redirect('/user/products')->with('success', 'Product Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

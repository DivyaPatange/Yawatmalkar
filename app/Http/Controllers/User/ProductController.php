<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\Product;
use Auth;
use App\Models\Admin\SubCategory;
use App\Models\Admin\UserInfo;
use App\Models\User\Item;

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
            ->addColumn('action', 'auth.product.action')
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
        $product->sub_category_id = $request->sub_category_id;
        $product->item_id = $request->item_id;
        $product->product_name = $request->product_name;
        $product->selling_price = $request->selling_price;
        $product->cost_price = $request->cost_price;
        $product->description = $request->description;
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
        $product = Product::findorfail($id);
        $userInfo = UserInfo::where('user_id', Auth::user()->id)->first();
        $subCategory = SubCategory::where('category_id', $userInfo->category_id)->get();
        $items = Item::where('sub_category_id', $product->sub_category_id)->get();
        return view('auth.product.edit', compact('product', 'subCategory', 'items'));
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
        $image_name = $request->hidden_img;
        $image = $request->file('product_img');
        if($image != '')
        {
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('ProductImg'), $image_name);
        }
        $input_data = array(
            'sub_category_id' => $request->sub_category_id,
            'item_id' => $request->item_id,
            'product_name' => $request->product_name,
            'product_img' => $image_name,
            'selling_price' => $request->selling_price,
            'cost_price' => $request->cost_price,
            'status' => $request->status,
            'description' => $request->description,
        );
        Product::whereId($id)->update($input_data);
        return redirect('/user/products')->with('success', 'Product Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findorfail($id);
        unlink(public_path('ProductImg/'.$product->product_img));
        $product->delete();
        return response()->json(['success' => 'Product Deleted Successfully!']);
    }
}

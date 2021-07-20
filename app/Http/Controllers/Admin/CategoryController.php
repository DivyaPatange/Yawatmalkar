<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        if(request()->ajax()) {
            return datatables()->of($category)
            ->addColumn('status', function($row){
                if($row->status == 1)
                return 'Active';
                else
                return 'Inactive';
            })
            ->addColumn('category_img', function($row){
                $imageUrl = asset('CategoryImg/'.$row->category_img);
                return '<img src="'.$imageUrl.'" width="100px">';
            })
            ->addColumn('action', 'admin.category.action')
            ->rawColumns(['action', 'category_img'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.category.index');
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
        $category = new Category();
        $category->category_name = $request->category_name;
        $category->status = $request->status;
        $image = $request->file('category_img');
        if($image != '')
        {
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('CategoryImg'), $image_name);
        }
        $category->category_img = $image_name;
        $category->save();
        return response()->json(['success' => 'Category Added Successfully']);
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

    public function getCategory(Request $request)
    {
        $category = Category::where('id', $request->bid)->first();
        if (!empty($category)) 
        {
            $data = array('id' =>$category->id,'category_name' =>$category->category_name,'status' =>$category->status, 'category_img' => $category->category_img
            );
        }else{
            $data =0;
        }
        echo json_encode($data);
        // return $brand;
    }

    public function updateCategory(Request $request)
    {
        $category = Category::where('id', $request->id)->first();
        $image_name = $request->hidden_img;
        $image = $request->file('category_img');
        if($image != '')
        {
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('CategoryImg'), $image_name);
        }
        $input_data = array (
            'category_name' => $request->category_name,
            'status' => $request->status,
            'category_img' => $image_name,
        );

        Category::whereId($category->id)->update($input_data);
        return response()->json(['success' => 'Category Updated Successfully']);
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
        $category = Category::findorfail($id);
        unlink(public_path('CategoryImg/'.$category->category_img));
        $category->delete();
        return response()->json(['success' => 'Category Deleted Successfully']);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use DB;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function getSubCategoryList(Request $request)
    {
        $subCategory = SubCategory::where("category_id", $request->category_id)->where('status', 1)
        ->pluck("sub_category","id");
        return response()->json($subCategory);
    }

    public function getUserList(Request $request)
    {
        $users = DB::table('users')
        ->join('user_infos', 'user_infos.user_id', '=', 'users.id')
        ->where("sub_category_id", $request->sub_category_id)->where('status', 1)->where('is_register', 'Yes')
        ->select('users.id', 'users.status', 'users.is_register', 'user_infos.sub_category_id', 'users.name')
        ->pluck("name","id");
        return response()->json($users);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('status', 1)->get();
        $subCategory = SubCategory::orderBy('id', 'DESC')->get();
        if(request()->ajax()) {
            return datatables()->of($subCategory)
            ->addColumn('image', function($row){
                $imageUrl = asset('SubCategoryImg/'.$row->image);
                return '<img src="'.$imageUrl.'" width="100px">';
            })
            ->addColumn('category_id', function(SubCategory $subCategory1){
                if(!empty($subCategory1->category->category_name)){
                return $subCategory1->category->category_name;
            }
            })
            ->addColumn('status', function($row){
                if($row->status == 1)
                return 'Active';
                else
                return 'Inactive';
            })
            ->addColumn('action', 'admin.subCategory.action')
            ->rawColumns(['action', 'image'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.subCategory.index', compact('categories'));
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
        $subCategory = new SubCategory();
        $subCategory->category_id = $request->category_name;
        $subCategory->sub_category = $request->sub_category;
        $subCategory->status = $request->status;
        $image = $request->file('image');
        if($image != '')
        {
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('subCategoryImg'), $image_name);
        }
        $subCategory->image = $image_name;
        $subCategory->description = $request->description;
        $subCategory->save();
        return response()->json(['success' => 'Sub-Category Added Successfully']);
    }

    public function getSubCategory(Request $request)
    {
        $subCategory = SubCategory::where('id', $request->bid)->first();
        if (!empty($subCategory)) 
        {
            $data = array('id' =>$subCategory->id,'category_name' =>$subCategory->category_id,'status' =>$subCategory->status, 'sub_category' => $subCategory->sub_category, 'image' => $subCategory->image, 'description' => $subCategory->description
            );
        }else{
            $data =0;
        }
        echo json_encode($data);
    }

    public function updateSubCategory(Request $request)
    {
        $subCategory = SubCategory::where('id', $request->id)->first();
        $image_name = $request->hidden_img;
        $image = $request->file('image');
        if($image != '')
        {
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('subCategoryImg'), $image_name);
        }
        $input_data = array (
            'category_id' => $request->category_name,
            'sub_category' => $request->sub_category,
            'image' => $image_name,
            'description' => $request->description,
            'status' => $request->status,
        );

        SubCategory::whereId($subCategory->id)->update($input_data);
        return response()->json(['success' => 'Sub-Category Updated Successfully']);
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
        $subCategory = SubCategory::findorfail($id);
        $subCategory->delete();
        return response()->json(['success' => 'Sub-Category Deleted Successfully']);
    }
}

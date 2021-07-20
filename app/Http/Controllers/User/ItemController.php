<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\Item;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use App\Models\Admin\UserInfo;
use Auth;

class ItemController extends Controller
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
        $data = Item::all();
        $userInfo = UserInfo::where('user_id', Auth::user()->id)->first();
        $categories = SubCategory::where('category_id', $userInfo->category_id)->where('status', 1)->get();
            // dd($data);
        if(request()->ajax()) 
        {
            return datatables()->of($data)
            ->addColumn('category_id', function($row){
                $category = Category::where('id', $row->category_id)->first();
                if(!empty($category))
                {
                    return $category->category_name;
                }
            })
            ->addColumn('sub_category_id', function($row){
                $subCategory = SubCategory::where('id', $row->sub_category_id)->first();
                if(!empty($subCategory))
                {
                    return $subCategory->sub_category;
                }
            })
            ->addColumn('status', function($row){
                if($row->status == 1)
                {
                    return '<span class="badge badge-success">Active</span>';
                }
                else{
                    return '<span class="badge badge-danger">Inactive</span>';
                }
            })
            ->addColumn('action', 'auth.item.action')
            ->rawColumns(['action','status'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('auth.item.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userInfo = UserInfo::where('user_id', Auth::user()->id)->first();
        $categories = SubCategory::where('category_id', $userInfo->category_id)->where('status', 1)->get();
        return view('auth.item.create', compact('categories'));
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
        $item = new Item();
        $item->category_id = $userInfo->category_id;
        $item->sub_category_id = $request->category_id;
        $item->item_name = $request->item_name;
        $item->status = $request->status;
        $item->save();
        return redirect('/user/items')->with('success', 'Item Added Successfully!');
    }

    public function getItem(Request $request)
    {
        $item = Item::where('id', $request->bid)->first();
        if (!empty($item)) 
        {
            $data = array('id' =>$item->id, 'sub_category_id' =>$item->sub_category_id, 'item_name' => $item->item_name, 'status' => $item->status
            );
        }else{
            $data =0;
        }
        echo json_encode($data);
    }

    public function updateItem(Request $request)
    {
        $item = Item::where('id', $request->id)->first();
        $input_data = array(
            'sub_category_id' => $request->category_id,
            'item_name' => $request->item_name,
            'status' => $request->status,
        );
        Item::whereId($item->id)->update($input_data);
        return response()->json(['success' => 'Item Updated Successfully!']);
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
        $item = Item::findorfail($id);
        $item->delete();
        return response()->json(['success' => 'Item Deleted Successfully!']);
    }

    public function getItemList(Request $request)
    {
        $item = Item::where("sub_category_id", $request->sub_category_id)->where('status', 1)
        ->pluck("item_name","id");
        return response()->json($item);
    }
}

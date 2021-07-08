<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Page;

class PagesController extends Controller
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
        $pages = Page::all();
        if(request()->ajax()) {
            return datatables()->of($pages)
            ->addColumn('status', function($row){
                if($row->status == 1)
                return 'Active';
                else
                return 'Inactive';
            })
            ->addColumn('action', 'admin.pages.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.pages.index');
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
        $page = new Page();
        $page->page_name = $request->page_name;
        $page->status = $request->status;
        $page->save();
        return response()->json(['success' => 'Page Name Added Successfully']);
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

    public function getPage(Request $request)
    {
        $page = Page::where('id', $request->bid)->first();
        if (!empty($page)) 
        {
            $data = array('id' =>$page->id,'page_name' =>$page->page_name,'status' =>$page->status
            );
        }else{
            $data =0;
        }
        echo json_encode($data);
        // return $brand;
    }

    public function updatePage(Request $request)
    {
        $page = Page::where('id', $request->id)->first();
        $input_data = array (
            'page_name' => $request->page_name,
            'status' => $request->status,
        );

        Page::whereId($page->id)->update($input_data);
        return response()->json(['success' => 'Page Name Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::findorfail($id);
        $page->delete();
        return response()->json(['success' => 'Page Name Deleted Successfully!']);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Flash;
use App\Models\Admin\Page;

class FlashesController extends Controller
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
        $pages = Page::where('status', 1)->get();
        $flashes = Flash::orderBy('id', 'DESC')->get();
        if(request()->ajax()) {
            return datatables()->of($flashes)
            ->addColumn('page_name', function($row){
                $page = Page::where('id', $row->page_id)->first();
                if(!empty($page))
                {
                    return $page->page_name;
                }
            })
            ->addColumn('image', function($row){
                $imageUrl = asset('FlashesUpcoming/' . $row->flash_img);
                return '<img src="'.$imageUrl.'" width="200px">';
            })
            ->addColumn('status', function($row){
                if($row->status == 1)
                return 'Active';
                else
                return 'Inactive';
            })
            ->addColumn('action', 'admin.flashes-upcoming.action')
            ->rawColumns(['action', 'image'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.flashes-upcoming.index', compact('pages'));
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
        $flashes = new Flash();
        $flashes->page_id = $request->page_name;
        $flashes->status = $request->status;
        $image = $request->file('image');
        if($image != '')
        {
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('FlashesUpcoming'), $image_name);
        }
        $flashes->flash_img = $image_name;
        $flashes->save();
        return response()->json(['success' => 'Flashes & Upcoming Added Successfully!']);
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

    public function getFlashesUpcoming(Request $request)
    {
        $flashes = Flash::where('id', $request->bid)->first();
        if (!empty($flashes)) 
        {
            $image = asset('FlashesUpcoming/'.$flashes->flash_img);
            $data = array('id' =>$flashes->id,'page_name' =>$flashes->page_id,'status' =>$flashes->status, 'hidden_img' => $flashes->flash_img, 'image' =>$image,
            );
        }else{
            $data =0;
        }
        echo json_encode($data);
    }

    public function updateFlashesUpcoming(Request $request)
    {
        $flashes = Flash::where('id', $request->id)->first();
        $image_name = $request->hidden_img;
        $image = $request->file('image');
        if($image != '')
        {
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('FlashesUpcoming'), $image_name);
        }
        $input_data = array (
            'page_id' => $request->page_name,
            'status' => $request->status,
            'flash_img' => $image_name,
        );

        Flash::whereId($flashes->id)->update($input_data);
        return response()->json(['success' => 'Flashes & Upcoming Updated Successfully!']);
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
        $flashes = Flash::findorfail($id);
        unlink(public_path('FlashesUpcoming/'.$flashes->flash_img));
        $flashes->delete();
        return response()->json(['success' => 'Flashes & Upcoming Deleted Successfully!']);
    }
}

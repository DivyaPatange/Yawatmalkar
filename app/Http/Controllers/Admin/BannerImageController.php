<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\BannerImage;
use App\Models\Admin\Category;

class BannerImageController extends Controller
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
        $bannerImage = BannerImage::all();
        $categories = Category::where('status', 1)->get();
        if(request()->ajax()) {
            return datatables()->of($bannerImage)
            ->addColumn('category_id', function($row){
                $category = Category::where('id', $row->category_id)->first();
                if(!empty($category))
                {
                    return $category->category_name;
                }
            })
            ->addColumn('banner_img', function($row){
                $imageUrl = asset('BannerImg/' . $row->banner_img);
                return '<img src="'.$imageUrl.'" width="25%">';
            })
            ->addColumn('status', function($row){
                if($row->status == 1)
                return 'Active';
                else
                return 'Inactive';
            })
            ->addColumn('action', 'admin.banner-img.action')
            ->rawColumns(['action', 'banner_img'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.banner-img.index', compact('categories'));
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
        $bannerImage = new BannerImage();
        $bannerImage->category_id = $request->category_id;
        $bannerImage->status = $request->status;
        $image = $request->file('banner_img');
        if($image != '')
        {
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('BannerImg'), $image_name);
        }
        $bannerImage->banner_img = $image_name;
        $bannerImage->save();
        return response()->json(['success' => 'Banner Image Added Successfully!']);
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

    public function getBannerImage(Request $request)
    {
        $bannerImage = BannerImage::where('id', $request->bid)->first();
        if (!empty($bannerImage)) 
        {
            $banner_img = asset('BannerImg/'.$bannerImage->banner_img);
            $data = array('id' =>$bannerImage->id,'category_id' =>$bannerImage->category_id,'status' =>$bannerImage->status, 'hidden_img' => $bannerImage->banner_img, 'banner_img' =>$banner_img,
            );
        }else{
            $data =0;
        }
        echo json_encode($data);
    }

    public function updateBannerImage(Request $request)
    {
        $bannerImage = BannerImage::where('id', $request->id)->first();
        $image_name = $request->hidden_img;
        $image = $request->file('banner_img');
        if($image != '')
        {
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('BannerImg'), $image_name);
        }
        $input_data = array (
            'category_id' => $request->category_id,
            'status' => $request->status,
            'banner_img' => $image_name,
        );

        BannerImage::whereId($bannerImage->id)->update($input_data);
        return response()->json(['success' => 'Banner Image Updated Successfully!']);
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
        $bannerImage = BannerImage::findorfail($id);
        unlink(public_path('BannerImg/'.$bannerImage->banner_img));
        $bannerImage->delete();
        return response()->json(['success' => 'Banner Image Deleted Successfully!']);
    }
}

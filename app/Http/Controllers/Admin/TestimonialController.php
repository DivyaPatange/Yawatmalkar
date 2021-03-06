<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Testimonial;
use App\Models\Admin\Category;

class TestimonialController extends Controller
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
        $categories = Category::where('status', 1)->get();
        $testimonials = Testimonial::all();
        if(request()->ajax()) {
            return datatables()->of($testimonials)
            ->addColumn('category_id', function($row){
                $category = Category::where('id', $row->category_id)->first();
                if(!empty($category))
                {
                    return $category->category_name;
                }
            })
            ->addColumn('image', function($row){
                $imageUrl = asset('TestimonialImg/' . $row->image);
                return '<img src="'.$imageUrl.'" width="100px">';
            })
            ->addColumn('status', function($row){
                if($row->status == 1)
                return 'Active';
                else
                return 'Inactive';
            })
            ->addColumn('action', 'admin.testimonial.action')
            ->rawColumns(['action', 'image', 'description'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.testimonial.index', compact('categories'));
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
        $testimonial = new Testimonial();
        $testimonial->category_id = $request->category_id;
        $image = $request->file('image');
        if($image != '')
        {
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('TestimonialImg'), $image_name);
        }
        $testimonial->image = $image_name;
        $testimonial->status = $request->status;
        $testimonial->description = $request->description;
        $testimonial->save();
        return response()->json(['success' => 'Testimonial Added Successfully!']);
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
        $categories = Category::where('status', 1)->get();
        $testimonial = Testimonial::findorfail($id);
        // dd($testimonial->category_id);
        return view('admin.testimonial.edit', compact('testimonial', 'categories'));
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
        $testimonial = Testimonial::findorfail($id);
        $image_name = $request->hidden_img;
        $image = $request->file('image');
        if($image != '')
        {
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('TestimonialImg'), $image_name);
        }
        $input_data = array(
            'category_id' => $request->category_id,
            'image' => $image_name,
            'description' => $request->description,
            'status' => $request->status,
        );
        Testimonial::whereId($id)->update($input_data);
        return redirect('/admin/testimonials')->with('success', 'Testimonial Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $testimonial = Testimonial::findorfail($id);
        unlink(public_path('TestimonialImg/'.$testimonial->image));
        $testimonial->delete();
        return response()->json(['success' => 'Testimonial Deleted Successfully!']);
    }
}

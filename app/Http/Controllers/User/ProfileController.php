<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin\UserInfo;
use App\Models\Admin\UserWorkingHour;
use App\Models\Admin\UserCertificate;
use DB;
use Auth;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;

class ProfileController extends Controller
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
        $user = User::where('id', Auth::user()->id)->first();
        $userInfo = UserInfo::where('user_id', Auth::user()->id)->first();
        $workingHour = UserWorkingHour::where('user_id', Auth::user()->id)->get();
        $certificates = UserCertificate::where('user_id', Auth::user()->id)->get();
        return view('auth.profile.index', compact('user', 'userInfo', 'workingHour', 'certificates'));
    }

    public function getSubCategoryList(Request $request)
    {
        $subCategory = SubCategory::where("category_id", $request->category_id)->where('status', 1)
            ->pluck("sub_category","id");
            return response()->json($subCategory);
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
        $category = Category::where('status', 1)->get();
        $user = User::findorfail($id);
        $userInfo = UserInfo::where('user_id', $id)->first();
        $subCategory = SubCategory::where('category_id', $userInfo->category_id)->get();
        return view('auth.profile.edit', compact('user', 'userInfo', 'category', 'subCategory'));
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
        $input_data = array (
            'name' => $request->name,
            'email' => $request->email,
        );
        $user = User::whereId($id)->update($input_data);
        $input_data1 = array (
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'contact_no' => $request->contact_no,
            'alt_contact_no' => $request->alt_contact_no,
            'aadhar_no' => $request->aadhar_no,
            'experience' => $request->experience,
            'qualification' => $request->qualification,
            'specialization' => $request->specialization,
            'working_hour' => $request->working_hour,
            'office_address' => $request->office_addr,
            'residential_address' => $request->residential_addr,
            'other_profession' => $request->other_profession,
            'dob' => $request->dob,
            'expectation' => $request->expectation
        );
        $userInfo = UserInfo::where('user_id', $id)->first();
        UserInfo::whereId($userInfo->id)->update($input_data1);
        return response()->json(['success' => 'Profile Updated Successfully!']);
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

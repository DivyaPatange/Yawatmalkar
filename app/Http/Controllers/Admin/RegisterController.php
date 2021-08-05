<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin\UserWorkingHour;
use App\Models\Admin\UserInfo;
use App\Models\Admin\UserCertificate;
use DB;
use App\Models\Role;

class RegisterController extends Controller
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
        if(request()->ajax()) 
        {
            $data = DB::table('users')->where('is_register', 'Yes')
            ->join('user_infos', 'user_infos.user_id', '=', 'users.id')
            ->select('users.*', 'user_infos.photo', 'user_infos.contact_no', 'user_infos.category_id', 'user_infos.sub_category_id')
            ->orderBy('id', 'DESC')->get();
            return datatables()->of($data)
            ->addColumn('photo', function($row){
                $imageUrl = asset('UserPhoto/' . $row->photo);
                return '<img src="'.$imageUrl.'" width="50px">';
            })
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
            ->addColumn('status', 'admin.register.status')
            ->addColumn('action', 'admin.register.action')
            ->rawColumns(['action','status', 'photo', 'category_id', 'sub_category_id'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.register.index');
    }

    public function getCategoryInfo(Request $request)
    {
        $category = Category::where('id', $request->categoryID)->first();
        return response()->json(['type' => $category->type]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::where('status', 1)->get();
        return view('admin.register.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $duplicate = User::where('username', $request->username)->where('is_register', '=', 'Yes')->first();
        if(empty($duplicate)){
            $id = mt_rand(100000, 999999);
            $user = new User();
            $user->name = $request->name;
            $user->employee_id = "YWM".$id;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->password_1 = $request->password;
            $user->is_register = 'No';
            $user->acc_type = $request->role;
            $user->save();


            $userInfo = new UserInfo();
            $userInfo->user_id = $user->id;
            $userInfo->category_id = $request->category_id;
            $userInfo->sub_category_id = $request->sub_category_id;
            $userInfo->contact_no = $request->contact_no;
            $userInfo->alt_contact_no = $request->alt_contact_no;
            $userInfo->aadhar_no = $request->aadhar_no;
            $userInfo->experience = $request->experience;
            $userInfo->qualification = $request->qualification;
            $userInfo->specialization = $request->specialization;
            $userInfo->office_address = $request->office_addr;
            $userInfo->residential_address = $request->residential_addr;
            $userInfo->working_hour = $request->working_hour;
            $userInfo->other_profession = $request->other_profession;
            $userInfo->dob = $request->dob;
            $userInfo->expectation = $request->expectation;
            $userInfo->achievements = $request->achievement;
            $userInfo->about_urself = $request->urself;
            $userInfo->busi_year = $request->busi_year;
            $userInfo->serve_capacity = $request->serve_capacity;
            $userInfo->save();
            
            $obj = json_decode($request->Data, true);
            for($i=0; $i < count($obj); $i++)
            {
                if(($obj[$i]["from"] != '') && ($obj[$i]["to"] != ''))
                {
                    $workingHour = new UserWorkingHour();
                    $workingHour->user_id = $user->id;
                    $workingHour->from = date("H:i", strtotime($obj[$i]["from"]));
                    $workingHour->to = date("H:i", strtotime($obj[$i]["to"]));
                    $workingHour->save();
                }
            }
            $userRole = Role::where('acc_type', $request->role)->first();
            $user->roles()->attach($userRole);
            return response()->json(['success' => 'Record Saved Successfully!', 'id' => $user->id]);
        }
        else{
            return response()->json(['error' => 'Username is already in use.']);
        }
    }

    public function uploadDocument(Request $request)
    {
        $user  = UserInfo::where('user_id', $request->user_id)->first();
        if(!empty($user)){
            $image = $request->file('photo');
            // dd($request->file('photo'));
            if($image != '')
            {
                $image_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('UserPhoto'), $image_name);
            }
            else{
                $image_name = "";
            }
            $image1 = $request->file('signature');
            // dd($request->file('photo'));
            if($image1 != '')
            {
                $image_name1 = rand() . '.' . $image1->getClientOriginalExtension();
                $image1->move(public_path('UserSignature'), $image_name1);
            }
            else{
                $image_name1 = "";
            }
            $result = UserInfo::where('user_id', $request->user_id)->update(['photo' => $image_name, 'signature' => $image_name1]);
        }
        if($request->hasfile('pdf_file'))
        {

            foreach($request->file('pdf_file') as $file)

            {

                $name = time().rand(1,100).'.'.$file->extension();

                $file->move(public_path('UserCertificate'), $name);  

                $files[] = $name;  

            }

        }
        $certificate_name = $request->certificate_name;
        if((count($certificate_name) > 0) && $request->hasfile('pdf_file')){
            for($i=0; $i < count($certificate_name); $i++)
            {
                if(($certificate_name[$i] != "") && ($files[$i] != "")){
                    $userCerti = new UserCertificate();
                    $userCerti->user_id = $request->user_id;
                    $userCerti->certificate_name = $certificate_name[$i];
                    $userCerti->certificate_pdf = $files[$i];
                    $userCerti->save();
                }
            }
        }
        return response()->json(['success' => 'Record Saved Successfully!', 'id' => $request->user_id]);
        // return $files;
    }

    public function saveGeneralInfo(Request $request)
    {
        $userInfo = UserInfo::where('user_id', $request->user_id)->first();
        $image = $request->file('passbook');
        if($image != '')
        {
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            // $image->storeAs('public/tempcourseimg',$image_name);
            $image->move(public_path('UserPassbook'), $image_name);
        }
        else{
            $image_name = "";
        }

        $image1 = $request->file('agreement');
        if($image1 != '')
        {
            $image_name1 = rand() . '.' . $image1->getClientOriginalExtension();
            // $image->storeAs('public/tempcourseimg',$image_name);
            $image1->move(public_path('UserAgreement'), $image_name1);
        }
        else{
            $image_name1 = "";
        }

        $image2 = $request->file('declare_sign');
        if($image2 != '')
        {
            $image_name2 = rand() . '.' . $image2->getClientOriginalExtension();
            // $image->storeAs('public/tempcourseimg',$image_name);
            $image2->move(public_path('UserDeclareSign'), $image_name2);
        }
        else{
            $image_name2 = "";
        }

        $image3 = $request->file('mou_sign');
        if($image3 != '')
        {
            $image_name3 = rand() . '.' . $image3->getClientOriginalExtension();
            // $image->storeAs('public/tempcourseimg',$image_name);
            $image3->move(public_path('UserMouSign'), $image_name3);
        }
        else{
            $image_name3 = "";
        }
        $input_data = array (
            'license' => $request->license,
            'bank_passbook' => $image_name,
            'agreement' => $image_name1,
            'joining_date' => $request->joining_date,
            'declaration_signed' => $image_name2,
            'mou_signed' => $image_name3,
            'youtube_link' => $request->link,
        );
        UserInfo::whereId($userInfo->id)->update($input_data);
        User::where('id', $request->user_id)->update(['is_register' => 'Yes']);
        return response()->json(['success' => 'Registration is Successfully Done.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findorfail($id);
        return view('admin.register.show', compact('user'));
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
        return view('admin.register.edit', compact('user', 'category', 'userInfo', 'subCategory'));
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
        User::whereId($id)->update($input_data);

        $input_data1 = array (
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'contact_no' => $request->contact_no,
            'alt_contact_no' => $request->alt_contact_no,
            'aadhar_no' => $request->aadhar_no,
            'experience' => $request->experience,
            'qualification' => $request->qualification,
            'specialization' => $request->specialization,
            'busi_year' => $request->busi_year,
            'serve_capacity' => $request->serve_capacity,
            'working_hour' => $request->working_hour,
            'office_address' => $request->office_addr,
            'residential_address' => $request->residential_addr,
            'other_profession' => $request->other_profession,
            'dob' => $request->dob,
            'expectation' => $request->expectation,
            'achievements' => $request->achievement,
            'about_urself' => $request->urself,
            'license' => $request->license,
            'joining_date' => $request->joining_date,
            'youtube_link' => $request->link,
        );
        $userInfo = UserInfo::where('user_id', $id)->first();
        UserInfo::whereId($userInfo->id)->update($input_data1);
        return redirect('/admin/register')->with('success', 'Record Updated Successfully!');
    }

    public function status(Request $request, $id)
    {
        $user = User::findorfail($id);
        if($user->status == 1)
        {
            $user->status = 0;
        }
        else{
            $user->status = 1;
        }
        $user->update($request->all());
        return response()->json(['success' => 'Status Changed Successfully!']);
    }

    public function editDocument($id)
    {
        $userInfo = UserInfo::where('user_id', $id)->first();
        $certificates = UserCertificate::where('user_id', $id)->get();
        return view('admin.register.edit-document', compact('userInfo', 'certificates'));
    }

    public function updateDocument(Request $request, $id)
    {
        $userInfo = UserInfo::where('user_id', $id)->first();
        $image_name = $request->hidden_photo;
        $image = $request->file('photo');
        if($image != '')
        {
            if($userInfo->photo)
            {
                unlink(public_path('UserPhoto/'.$userInfo->photo));
            }
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('UserPhoto'), $image_name);
        }

        $image_name1 = $request->hidden_signature;
        $image1 = $request->file('signature');
        if($image1 != '')
        {
            if($userInfo->signature)
            {
                unlink(public_path('UserSignature/'.$userInfo->signature));
            }
            $image_name1 = rand() . '.' . $image1->getClientOriginalExtension();
            $image1->move(public_path('UserSignature'), $image_name1);
        }

        $image_name2 = $request->hidden_passbook;
        $image2 = $request->file('passbook');
        if($image2 != '')
        {
            if($userInfo->bank_passbook)
            {
                unlink(public_path('UserPassbook/'.$userInfo->bank_passbook));
            }
            $image_name2 = rand() . '.' . $image2->getClientOriginalExtension();
            $image2->move(public_path('UserPassbook'), $image_name2);
        }

        $image_name3 = $request->hidden_agreement;
        $image3 = $request->file('agreement');
        if($image3 != '')
        {
            if($userInfo->agreement)
            {
                unlink(public_path('UserAgreement/'.$userInfo->agreement));
            }
            $image_name3 = rand() . '.' . $image3->getClientOriginalExtension();
            $image3->move(public_path('UserPassbook'), $image_name3);
        }

        $image_name4 = $request->hidden_declare;
        $image4 = $request->file('declare_sign');
        if($image4 != '')
        {
            if($userInfo->declaration_signed)
            {
                unlink(public_path('UserDeclareSign/'.$userInfo->declaration_signed));
            }
            $image_name4 = rand() . '.' . $image4->getClientOriginalExtension();
            $image4->move(public_path('UserDeclareSign'), $image_name4);
        }

        $image_name5 = $request->hidden_mou;
        $image5 = $request->file('mou_sign');
        if($image5 != '')
        {
            if($userInfo->mou_signed)
            {
                unlink(public_path('UserMouSign/'.$userInfo->declaration_signed));
            }
            $image_name5 = rand() . '.' . $image5->getClientOriginalExtension();
            $image5->move(public_path('UserMouSign'), $image_name5);
        }

        $input_data = array (
            'photo' => $image_name,
            'signature' => $image_name1,
            'bank_passbook' => $image_name2,
            'agreement' => $image_name3,
            'declaration_signed' => $image_name4,
            'mou_signed' => $image_name5,
        );
        if($request->certificate_name && $request->hasfile('pdf_file'))
        {
            if($request->hasfile('pdf_file'))
            {
    
                foreach($request->file('pdf_file') as $file)
    
                {
    
                    $name = time().rand(1,100).'.'.$file->extension();
    
                    $file->move(public_path('UserCertificate'), $name);  
    
                    $files[] = $name;  
    
                }
    
            }
            $certificate_name = $request->certificate_name;
            if((count($certificate_name) > 0) && $request->hasfile('pdf_file')){
                for($i=0; $i < count($certificate_name); $i++)
                {
                    if(($certificate_name[$i] != "") && ($files[$i] != "")){
                        $userCerti = new UserCertificate();
                        $userCerti->user_id = $userInfo->user_id;
                        $userCerti->certificate_name = $certificate_name[$i];
                        $userCerti->certificate_pdf = $files[$i];
                        $userCerti->save();
                    }
                }
            }
        }
        UserInfo::whereId($userInfo->id)->update($input_data);
        return redirect('/admin/register')->with('success', 'Documents Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findorfail($id);
        $userInfo = UserInfo::where('user_id', $id)->first();
        $userCerti = UserCertificate::where('user_id', $id)->get();
        $workingHour = UserWorkingHour::where('user_id', $id)->get();
        $user->roles()->detach();
        $user->delete();
        if($userInfo->photo){
            unlink(public_path('UserPhoto/'.$userInfo->photo));
        }
        if($userInfo->signature){
            unlink(public_path('UserSignature/'.$userInfo->signature));
        }
        $userInfo->delete();
        if(count($userCerti) > 0){
            foreach($userCerti as $d)
            {
                $deleteCerti = UserCertificate::where('id', $d->id)->first();
                if($deleteCerti->pdf_file){
                    unlink(public_path('UserCertificate/'.$deleteCerti->pdf_file));
                }
                $deleteCerti->delete();
            }
        }
        if(count($workingHour) > 0){
            foreach($workingHour as $wH)
            {
                $deleteWorkingHour = UserWorkingHour::where('id', $wH->id)->first();
                $deleteWorkingHour->delete();
            }
        }
        return response()->json(['success' => 'Record Deleted Successfully!']);
    }
}

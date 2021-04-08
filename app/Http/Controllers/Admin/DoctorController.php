<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\SubCategory;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin\DoctorWorkingHour;
use App\Models\Admin\DoctorInfo;
use App\Models\Admin\DoctorCertificate;
use DB;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) 
        {
            $data = DB::table('doctors')->where('is_register', 'Yes')
            ->join('doctor_infos', 'doctor_infos.doctor_id', '=', 'doctors.id')
            ->select('doctors.*', 'doctor_infos.photo')
            ->orderBy('id', 'DESC')->get();
            return datatables()->of($data)
            ->addColumn('photo', function($row){
                $imageUrl = asset('DoctorPhoto/' . $row->photo);
                return '<img src="'.$imageUrl.'" width="50px">';
            })
            ->addColumn('status', 'admin.doctors.status')
            ->addColumn('action', 'admin.doctors.action')
            ->rawColumns(['action','status', 'photo'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.doctors.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::where('status', 1)->get();
        return view('admin.doctors.create', compact('category'));
    }

    public function getSubCategoryList(Request $request)
    {
        $subCategory = SubCategory::where("category_id", $request->category_id)->where('status', 1)
            ->pluck("sub_category","id");
            return response()->json($subCategory);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $duplicate = Doctor::where('username', $request->username)->first();
        if(empty($duplicate)){
            $id = mt_rand(100000, 999999);
            $doctor = new Doctor();
            $doctor->doctor_name = $request->doctor_name;
            $doctor->category_id = $request->category_id;
            $doctor->sub_category_id = $request->sub_category_id;
            $doctor->contact_no = $request->contact_no;
            $doctor->alt_contact_no = $request->alt_contact_no;
            $doctor->aadhar_no = $request->aadhar_no;
            $doctor->email = $request->email;
            $doctor->experience = $request->experience;
            $doctor->qualification = $request->qualification;
            $doctor->specialization = $request->specialization;
            $doctor->office_address = $request->office_addr;
            $doctor->residential_address = $request->residential_addr;
            $doctor->working_hour = $request->working_hour;
            $doctor->other_profession = $request->other_profession;
            $doctor->dob = $request->dob;
            $doctor->expectation = $request->expectation;
            $doctor->achievements = $request->achievement;
            $doctor->about_urself = $request->urself;
            $doctor->doctor_id = "YWM".$id;
            $doctor->username = $request->username;
            $doctor->password = Hash::make($request->password);
            $doctor->password_1 = $request->password;
            $doctor->is_register = 'No';
            $doctor->save();
            $obj = json_decode($request->Data, true);
            for($i=0; $i < count($obj); $i++)
            {
                if(($obj[$i]["from"] != '') && ($obj[$i]["to"] != ''))
                {
                    $workingHour = new DoctorWorkingHour();
                    $workingHour->doctor_id = $doctor->id;
                    $workingHour->from = date("H:i", strtotime($obj[$i]["from"]));
                    $workingHour->to = date("H:i", strtotime($obj[$i]["to"]));
                    $workingHour->save();
                }
            }
            return response()->json(['success' => 'Record Saved Successfully!', 'id' => $doctor->id]);
        }
        else{
            return response()->json(['error' => 'Username is already in use.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doctor = Doctor::findorfail($id);
        return view('admin.doctors.show', compact('doctor'));
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
        $doctor = Doctor::findorfail($id);
        $doctorInfo = DoctorInfo::where('doctor_id', $id)->first();
        $doctorCerti = DoctorCertificate::where('doctor_id', $id)->get();
        $doctor->delete();
        if($doctorInfo->photo){
            unlink(public_path('DoctorPhoto/'.$doctorInfo->photo));
        }
        if($doctorInfo->signature){
            unlink(public_path('DoctorSignature/'.$doctorInfo->signature));
        }
        $doctorInfo->delete();
        if(count($doctorCerti) > 0){
            foreach($doctorCerti as $d)
            {
                $deleteCerti = DoctorCertificate::where('id', $d->id)->first();
                if($deleteCerti->pdf_file){
                    unlink(public_path('DoctorCertificate/'.$deleteCerti->pdf_file));
                }
                $deleteCerti->delete();
            }
        }
        return response()->json(['success' => 'Record Deleted Successfully!']);
    }

    public function uploadDocument(Request $request)
    {
        $doctor  = DoctorInfo::where('doctor_id', $request->doctor_id)->first();
        if(empty($doctor)){
            $doctorInfo = new DoctorInfo();
            $doctorInfo->doctor_id = $request->doctor_id;
            $image = $request->file('photo');
            // dd($request->file('photo'));
            if($image != '')
            {
                $image_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('DoctorPhoto'), $image_name);
                $doctorInfo->photo =$image_name;
            }
            $image1 = $request->file('signature');
            // dd($request->file('photo'));
            if($image1 != '')
            {
                $image_name1 = rand() . '.' . $image1->getClientOriginalExtension();
                $image1->move(public_path('DoctorSignature'), $image_name1);
                $doctorInfo->signature =$image_name1;
            }
            $doctorInfo->save();
        }
        if($request->hasfile('pdf_file'))
        {

            foreach($request->file('pdf_file') as $file)

            {

                $name = time().rand(1,100).'.'.$file->extension();

                $file->move(public_path('DoctorCertificate'), $name);  

                $files[] = $name;  

            }

        }
        $certificate_name = $request->certificate_name;
        if((count($certificate_name) > 0) && (count($files) > 0)){
            for($i=0; $i < count($certificate_name); $i++)
            {
                if(($certificate_name[$i] != "") && ($files[$i] != "")){
                    $doctorCerti = new DoctorCertificate();
                    $doctorCerti->doctor_id = $request->doctor_id;
                    $doctorCerti->certificate_name = $certificate_name[$i];
                    $doctorCerti->certificate_pdf = $files[$i];
                    $doctorCerti->save();
                }
            }
        }
        return response()->json(['success' => 'Record Saved Successfully!', 'id' => $request->doctor_id]);
        // return count($certificate_name);
    }

    public function saveGeneralInfo(Request $request)
    {
        $doctorInfo = DoctorInfo::where('doctor_id', $request->doctor_id)->first();
        $image = $request->file('passbook');
        if($image != '')
        {
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            // $image->storeAs('public/tempcourseimg',$image_name);
            $image->move(public_path('doctorPassbook'), $image_name);
        }
        else{
            $image_name = "";
        }

        $image1 = $request->file('agreement');
        if($image1 != '')
        {
            $image_name1 = rand() . '.' . $image1->getClientOriginalExtension();
            // $image->storeAs('public/tempcourseimg',$image_name);
            $image1->move(public_path('DoctorAgreement'), $image_name1);
        }
        else{
            $image_name1 = "";
        }

        $image2 = $request->file('declare_sign');
        if($image2 != '')
        {
            $image_name2 = rand() . '.' . $image2->getClientOriginalExtension();
            // $image->storeAs('public/tempcourseimg',$image_name);
            $image2->move(public_path('DoctorDeclareSign'), $image_name2);
        }
        else{
            $image_name2 = "";
        }

        $image3 = $request->file('mou_sign');
        if($image3 != '')
        {
            $image_name3 = rand() . '.' . $image3->getClientOriginalExtension();
            // $image->storeAs('public/tempcourseimg',$image_name);
            $image3->move(public_path('DoctorMouSign'), $image_name3);
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
        DoctorInfo::whereId($doctorInfo->id)->update($input_data);
        Doctor::where('id', $request->doctor_id)->update(['is_register' => 'Yes']);
        return response()->json(['success' => 'Registration is Successfully Done.']);
    }

    public function status(Request $request, $id)
    {
        $doctor = Doctor::findorfail($id);
        if($doctor->status == 1)
        {
            $doctor->status = 0;
        }
        else{
            $doctor->status = 1;
        }
        $doctor->update($request->all());
        return response()->json(['success' => 'Doctor Status Changed Successfully!']);
    }
}

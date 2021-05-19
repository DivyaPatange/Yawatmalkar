<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin\Schedule;
use DB;

class LawyerScheduleController extends Controller
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
        $users = User::where('acc_type', 'lawyer')->where('is_register', 'Yes')->where('status', 1)->get();
        $data = DB::table('users')
            ->join('schedules', 'schedules.user_id', '=', 'users.id')
            ->where('users.is_register', 'Yes')->where('users.acc_type', 'lawyer')->where('users.status', 1)
            ->select('schedules.*', 'users.name')
            ->orderBy('id', 'DESC')->get();
            // dd($data);
        if(request()->ajax()) 
        {
            return datatables()->of($data)
            ->addColumn('schedule_date', function($row){
                return date("d-m-Y", strtotime($row->schedule_date));
            })
            ->addColumn('schedule_day', function($row){
                $date = $row->schedule_date;
                //Get the day of the week using PHP's date function.
                $dayOfWeek = date("l", strtotime($date));
                return $dayOfWeek;
            })
            ->addColumn('start_time', function($row){
                return date("g:iA", strtotime($row->start_time));
            })
            ->addColumn('end_time', function($row){
                return date("g:iA", strtotime($row->end_time));
            })
            ->addColumn('consulting_time', function($row){
                return $row->consulting_time." Min";
            })
            ->addColumn('status', 'admin.lawyerSchedule.status')
            ->addColumn('action', 'admin.lawyerSchedule.action')
            ->rawColumns(['action','status', 'schedule_day', 'consulting_time'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.lawyerSchedule.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('acc_type', 'lawyer')->where('is_register', 'Yes')->where('status', 1)->get();
        return view('admin.lawyerSchedule.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $schedule = new Schedule();
        $schedule->user_id = $request->name;
        $schedule->schedule_date = $request->s_date;
        $schedule->start_time = $request->start_time;
        $schedule->end_time = $request->end_time;
        $schedule->consulting_time = $request->time;
        $schedule->status = "Active";
        $schedule->save();
        return redirect('/admin/lawyer-schedule')->with('success', 'Schedule Created Successfully!');
    }

    public function getLawyerSchedule(Request $request)
    {
        $schedule = Schedule::where('id', $request->bid)->first();
        $user = User::where('id', $schedule->user_id)->first();
        if(!empty($user))
        {
            $userName = $user->id;
        }
        else{
            $userName = "";
        }
        if (!empty($schedule)) 
        {
            $data = array('id' =>$schedule->id,'name' =>$userName,'schedule_date' =>$schedule->schedule_date, 'start_time' => $schedule->start_time, 'end_time' => $schedule->end_time, 'consulting_time' => $schedule->consulting_time,
            );
        }else{
            $data =0;
        }
        echo json_encode($data);
        // return $brand;
    }

    public function updateLawyerSchedule(Request $request)
    {
        $schedule = Schedule::where('id', $request->id)->first();
        $input_data = array (
            'user_id' => $request->name,
            'schedule_date' => $request->s_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'consulting_time' => $request->time,
        );

        Schedule::whereId($schedule->id)->update($input_data);
        return response()->json(['success' => 'Schedule Data Updated Successfully']);
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
        $schedule = Schedule::findorfail($id);
        $schedule->delete();
        return response()->json(['success' => 'Record Deleted Successfully!']);
    }

    public function status(Request $request, $id)
    {
        $schedule = Schedule::findorfail($id);
        if($schedule->status == "Active")
        {
            $schedule->status = "Inactive";
        }
        else{
            $schedule->status = "Active";
        }
        $schedule->update($request->all());
        return response()->json(['success' => 'Status Changed Successfully!']);
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Admin\Schedule;

class UserScheduleController extends Controller
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
        // dd(Auth::user()->id);
        $data = DB::table('users')
            ->where('users.id', Auth::user()->id)
            ->join('schedules', 'schedules.user_id', '=', 'users.id')
            ->select('schedules.*')
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
            ->addColumn('status', 'auth.schedule.status')
            ->addColumn('action', 'auth.schedule.action')
            ->rawColumns(['action','status', 'schedule_day', 'consulting_time'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('auth.schedule.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.schedule.create');
    }

    public function getList()
    {
        $data = DB::table('users')
            ->where('users.id', Auth::user()->id)
            ->join('schedules', 'schedules.user_id', '=', 'users.id')
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
            ->addColumn('status', 'auth.schedule.status')
            ->addColumn('action', 'auth.schedule.action')
            ->rawColumns(['action','status', 'schedule_day'])
            ->addIndexColumn()
            ->make(true);
        }
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
        $schedule->user_id = Auth::user()->id;
        $schedule->schedule_date = $request->s_date;
        $schedule->start_time = $request->start_time;
        $schedule->end_time = $request->end_time;
        $schedule->consulting_time = $request->time;
        $schedule->max_appointment = $request->appointment;
        $schedule->status = "Active";
        $schedule->save();
        return redirect('/user/schedule')->with('success', 'Schedule Created Successfully!');
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

    public function getSchedule(Request $request)
    {
        $schedule = Schedule::where('id', $request->bid)->first();
        if (!empty($schedule)) 
        {
            $data = array('id' =>$schedule->id, 'schedule_date' =>$schedule->schedule_date, 'start_time' => $schedule->start_time, 'end_time' => $schedule->end_time, 'consulting_time' => $schedule->consulting_time, 'max_appointment' => $schedule->max_appointment
            );
        }else{
            $data =0;
        }
        echo json_encode($data);
        // return $brand;
    }

    public function updateSchedule(Request $request)
    {
        $schedule = Schedule::where('id', $request->id)->first();
        $input_data = array (
            'schedule_date' => $request->s_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'consulting_time' => $request->time,
            'max_appointment' => $request->appointment,
        );

        Schedule::whereId($schedule->id)->update($input_data);
        return response()->json(['success' => 'Schedule Data Updated Successfully']);
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

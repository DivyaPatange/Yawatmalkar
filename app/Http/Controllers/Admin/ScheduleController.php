<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin\Schedule;
use DB;
use App\Models\Admin\Category;

class ScheduleController extends Controller
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
        $users = User::where('is_register', 'Yes')->where('status', 1)->get();
        // dd($users);
        $data = DB::table('users')
            ->join('schedules', 'schedules.user_id', '=', 'users.id')
            ->where('users.is_register', 'Yes')->where('users.status', 1)
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
                return date("g:i A", strtotime($row->start_time));
            })
            ->addColumn('end_time', function($row){
                return date("g:i A", strtotime($row->end_time));
            })
            ->addColumn('consulting_time', function($row){
                if($row->consulting_time){
                    return $row->consulting_time." Min";
                }
                else{
                    return $row->max_appointment;
                }
            })
            ->addColumn('status', 'admin.doctorSchedule.status')
            ->addColumn('action', 'admin.doctorSchedule.action')
            ->rawColumns(['action','status', 'schedule_day', 'consulting_time'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('admin.scheduleData.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status', 1)->get();
        $users = User::where('acc_type', 'doctor')->where('is_register', 'Yes')->where('status', 1)->get();
        return view('admin.scheduleData.create', compact('users', 'categories'));
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
        $schedule->category_id = $request->category_id;
        $schedule->sub_category_id = $request->sub_category_id;
        $schedule->max_appointment = $request->appointment;
        $schedule->status = "Active";
        $schedule->save();
        return redirect('/admin/schedule-data')->with('success', 'Schedule Created Successfully!');
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
        //
    }
}

<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::now();

        $totalEmployees = DB::table('employees')->count();
        $todayAttendence = DB::table('attendances')->whereDate('attendance_date',$today)->where('status','present')->count();
        $todayLeave = DB::table('leaves')->whereDate('leave_date',$today)->count();
        $upcomingHoliday = DB::table('holidays')->whereDate('holiday_date','>',$today)->whereMonth('holiday_date',$today)->get();
        $dailyHistory = DB::table('employees')
                        ->select(
                            DB::raw('COUNT(DISTINCT employees.id) as totalEmp'),
                            DB::raw('COUNT(CASE WHEN attendances.status = "present" AND attendances.attendance_date = CURDATE() THEN 1 END) as todayPresent'),
                            DB::raw('COUNT(DISTINCT employees.id) - COUNT(CASE WHEN attendances.status = "present" AND attendances.attendance_date = CURDATE() THEN 1 END) as todayAbsent')
                        )
                        ->leftJoin('attendances', 'employees.id', '=', 'attendances.employee_id')
                        ->get();


        $leaveHistory = DB::table('leaves')
                        ->whereMonth('leave_date', $today)
                        ->join('employees', 'leaves.employee_id', '=', 'employees.id')
                        ->select('leaves.*', 'employees.*')
                        ->get();

        $user = Auth::user();

        return response()->json([
            'totalEmployees' => $totalEmployees,
            'todayAttendence' => $todayAttendence,
            'todayLeave' => $todayLeave,
            'upcomingHoliday' => $upcomingHoliday,
            'dailyHistory' => $dailyHistory,
            'leaveHistory' => $leaveHistory,
            'user' => $user
        ]);
    }
}

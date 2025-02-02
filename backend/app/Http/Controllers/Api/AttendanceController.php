<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $today = date('Y-m-d');
        $attendances = DB::table('attendances')
            ->join('employees', 'attendances.employee_id', '=', 'employees.id')
            ->join('departments', 'employees.department_id', '=', 'departments.id')
            ->whereDate('attendances.attendance_date', $today)
            ->select(
                'departments.name as department_name',
                'employees.full_name as employee_name',
                'attendances.check_in_time',
                'attendances.check_out_time',
                'attendances.status',
                'attendances.employee_id as employee_id',
                'employees.department_id'
            )
            ->orderBy('employees.department_id')
            ->get()
            ->groupBy('department_name');

        return $attendances;
//        return response()->json($attedance);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attendances = DB::table('attendances')
            ->join('employees', 'attendances.employee_id', '=', 'employees.id')
            ->join('departments', 'employees.department_id', '=', 'departments.id')
            ->whereDate('attendances.attendance_date', $request->date)
            ->select(
                'departments.name as department_name',
                'employees.full_name as employee_name',
                'attendances.check_in_time',
                'attendances.check_out_time',
                'attendances.status',
                'attendances.employee_id as employee_id',
                'employees.department_id'
            )
            ->orderBy('employees.department_id')
            ->get()
            ->groupBy('department_name');

        return $attendances;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $report = DB::table('attendances')
        ->select('employee_id',DB::raw('COUNT(attendance_date) as total_present'))
        // ->whereMonth('attendance_date',)
        ->where('employee_id',$id)
        ->groupBy('employee_id')

        ->get();
        return $report;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        [$year, $monthNumber] = explode('-', $request->input('month'));
    $totalDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $monthNumber, $year);

    // Count the number of Fridays in the given month
    $totalFridays = 0;
    for ($day = 1; $day <= $totalDaysInMonth; $day++) {
        if (date('N', strtotime("$year-$monthNumber-$day")) == 5) { // 5 = Friday
            $totalFridays++;
        }
    }

    $report = DB::table('attendances')
        ->join('employees', 'attendances.employee_id', '=', 'employees.id')
        ->select(
            'attendances.employee_id',
            'employees.full_name as employee_name',
            DB::raw("COUNT(CASE WHEN attendances.status = 'Present' THEN 1 END) as total_present"),
            DB::raw("COUNT(CASE WHEN attendances.status = 'Leave' THEN 1 END) as total_leave"),
            DB::raw("COUNT(CASE WHEN attendances.status = 'Holiday' THEN 1 END) as total_holiday"),
            DB::raw("$totalDaysInMonth as total_days_in_month"),
            DB::raw("$totalFridays as total_weekends")
        )
        ->whereRaw("DATE_FORMAT(attendances.attendance_date, '%Y-%m') = ?", ["$year-$monthNumber"])
        ->where('attendances.employee_id', $id)
        ->groupBy('attendances.employee_id', 'employees.full_name')
        ->first(); // Fetch a single employee record

    if ($report) {
        // Calculate Total Absent (excluding Fridays)
        $report->total_absent = $totalDaysInMonth - ($report->total_present + $report->total_leave + $report->total_holiday + $totalFridays);
    }

    return response()->json($report);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

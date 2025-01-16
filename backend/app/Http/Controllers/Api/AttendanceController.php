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
        $attedance = DB::table('attendances')->whereDate('attendances.attendance_date', $today)
            ->join('employees','attendances.employee_id','=','employees.id')
            ->join('departments','employees.department_id','=','departments.id')
            ->select(
                'employees.department_id',
                'departments.name as department_name',
                'employees.full_name as employee_name',
                'attendances.check_in_time',
                'attendances.check_out_time',
                'attendances.status',

            )
            ->get()->groupBy('department_name');
        return $attedance;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

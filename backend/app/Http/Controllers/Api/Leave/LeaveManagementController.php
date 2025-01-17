<?php

namespace App\Http\Controllers\Api\Leave;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaveManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $departments = DB::table('departments')->get();
        $query = DB::table('leaves');

        if ($request->filled('year')) {
            $query->whereYear('leave_date', $request->year);
        }
        if ($request->filled('month')) {
            $query->whereMonth('leave_date', $request->month);
        }
        $now = Carbon::now()->month;
        $leaves = $query->join('employees', 'employees.id', '=', 'leaves.employee_id')
            ->join('departments', 'departments.id', '=', 'employees.department_id')
            ->orderBy('leaves.created_at', 'desc')
            ->whereMonth('leaves.leave_date',$now)
            ->get();
        return $leaves;

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
        try {
            $validated = $request->validate([
                'employee' => 'required|exists:employees,id',
                'leave_type' => 'required|in:sick,casual,earned,others',
                'leave_start_date' => 'required|date|before_or_equal:leave_end_date',
                'leave_end_date' => 'required|date|after_or_equal:leave_start_date',
            ]);

            $employeeId = $validated['employee'];
            $leaveType = $validated['leave_type'];
            $leaveStartDate = Carbon::parse($validated['leave_start_date']);
            $leaveEndDate = Carbon::parse($validated['leave_end_date']);

            $leaveDates = [];
            for ($date = $leaveStartDate; $date <= $leaveEndDate; $date->addDay()) {
                $leaveDates[] = $date->format('Y-m-d');
            }

            $daysTaken = count($leaveDates);

            foreach ($leaveDates as $date) {
                Leave::create([
                    'employee_id' => $employeeId,
                    'leave_type' => $leaveType,
                    'leave_date' => $date,
                    'days_taken' => $daysTaken,
                ]);
            }

            return redirect()->route('leaves.index')->with('success', 'Leave request created successfully');
        } catch (Exception $e) {
            return redirect()->route('leaves.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        try {
            $leave = Leave::findOrFail($id);
            $leave->delete();

            return redirect()->route('leaves.index')->with('success', 'Leave request deleted successfully');
        } catch (Exception $e) {
            return redirect()->route('leaves.index')->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}

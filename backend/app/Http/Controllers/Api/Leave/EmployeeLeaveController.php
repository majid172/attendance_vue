<?php

namespace App\Http\Controllers\Api\Leave;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

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
        $employee = DB::table('employees')->find($request->employee);
        $monthlyStatus = DB::table('leaves')
                        ->select(DB::raw('MONTH(leave_date) as month, SUM(days_taken) as total_leaves'))
                        ->where('employee_id', $request->employee)
                        ->whereYear('leave_date', $request->year)
                        ->groupBy(DB::raw('MONTH(leave_date)'))
                        ->orderBy(DB::raw('MONTH(leave_date)'))
                        ->get();

// Map month numbers (1-12) to month names (January, February, etc.)
$monthNames = [
    1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June',
    7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
];

// Initialize an empty array to store the results
$formattedMonthlyStatus = [];

// Loop through months 1 to 12 and add corresponding data to the result
foreach (range(1, 12) as $monthNumber) {
    // Find data for the current month
    $monthData = $monthlyStatus->firstWhere('month', $monthNumber);

    // If data for the month exists, use it, otherwise set total_leaves to 0
    $formattedMonthlyStatus[] = [
        'month' => $monthNames[$monthNumber],
        'total_leaves' => $monthData ? $monthData->total_leaves : 0
    ];
}

return response()->json([
    'formattedMonthlyStatus' => $formattedMonthlyStatus,
    'employee' => $employee
]);

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
        //
    }
}

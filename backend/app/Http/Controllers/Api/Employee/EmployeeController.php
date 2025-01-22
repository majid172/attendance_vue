<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = DB::table('employees')->join('departments','employees.department_id','=','departments.id')
            ->select('employees.*','departments.name')
            ->get();
        return $employees;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return 'cerate';
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $employee = DB::table('employees')->where('id',$id)->first();
        return $employee;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        DB::table('employees')
            ->where('id', $id)
            ->update([
                'full_name' => $request->input('full_name'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'designation' => $request->input('emp_designation'),
            ]);

        // Fetch and return the updated employee
        $updatedEmployee = DB::table('employees')->where('id', $id)->first();
        return response()->json([
            'employee' => $updatedEmployee,
            'status' => 'success',
            'message' => 'Employee updated successfully.',
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $employee = DB::table('employees')->where('id',$id);
            $employee->delete();
            return 'Holiday deleted successfully';
//            return redirect()->route('holidays.index')->with('success', 'Holiday deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('holidays.index')->with('error', 'Failed to delete holiday.');
        }
    }
}

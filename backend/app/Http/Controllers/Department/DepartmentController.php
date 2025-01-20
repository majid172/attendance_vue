<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = DB::table('departments')->get();
        return response()->json($departments);
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
        $department = DB::table('departments')->where('id', $id)->first();
        return $department;
    }

    public function update(Request $request, string $id)
    {
//        $request->validate([
//            'dep_name' => 'required|string|max:255',
//        ]);
        $department = DB::table('departments')->where('id', $id)->first();
        if (!$department) {
            return response()->json(['message' => 'Department not found.'], 404);
        }
        DB::table('departments')
            ->where('id', $id)
            ->update(['name' => $request->dep_name]);

        $updatedDepartment = DB::table('departments')->where('id', $id)->first();

        return response()->json([
            'department' => $updatedDepartment,
            'status' => 'success',
            'message' => 'Department updated successfully.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

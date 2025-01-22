<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = DB::table('holidays');

        if ($request->filled('year')) {
            $query->whereYear('holiday_date', $request->year);
        }

        if ($request->filled('month')) {
            $query->whereMonth('holiday_date', $request->month);
        }

        $holidays = $query->orderBy('holiday_date', 'asc')->get();
        return $holidays;

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // Validate the request
//        $validated = $request->validate([
//            'holiday_name' => 'required|string|max:255',
//            'holiday_date' => 'required|date',
//        ], [
//            'holiday_name.unique' => 'The holiday name you entered already exists.',
//        ]);

        try {
            // Create the holiday record in the database
            DB::table('holidays')->insert($request->all());

            // Return a success response
            return response()->json([
                'status' => 'success',
                'message' => 'Holiday created successfully.',
                'data' => $request->all()
            ], 201); // 201 = Created
        } catch (\Exception $e) {
            // Return an error response
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create holiday.',
                'error' => $e->getMessage(),
            ], 500); // 500 = Internal Server Error
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
        $holiday = DB::table('holidays')->where('id', $id)->first();
        return $holiday;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
//        $request->validate([
//            'holiday_name' => 'required|string|max:255',
//            'holiday_date' => 'required|date',
//        ]);
        $holiday = DB::table('holidays')->where('id', $id)->first();
        if (!$holiday) {
            return response()->json(['message' => 'Department not found.'], 404);
        }
        DB::table('holidays')
            ->where('id', $id)
            ->update(['holiday_name' => $request->holiday_name,
                       'holiday_date' => $request->holiday_date
                ]);

        $updatedHoliday = DB::table('holidays')->where('id', $id)->first();

        return response()->json([
            'holiday' => $updatedHoliday,
            'status' => 'success',
            'message' => 'Holiday updated successfully.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $holiday = DB::table('holidays')->where('id',$id);
            $holiday->delete();
            return 'Holiday deleted successfully';
//            return redirect()->route('holidays.index')->with('success', 'Holiday deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('holidays.index')->with('error', 'Failed to delete holiday.');
        }
    }
}

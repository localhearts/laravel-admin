<?php

namespace App\Http\Controllers;

use App\Exports\ExportAttendance;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportAttendance;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Attendance::with(['employee' => function ($query) {
                $query->select('id', 'fullname', 'position');
            }])
                ->get();


            return Datatables::of($data)
                ->editColumn('date', function ($data) {
                    return $data->check_out ? with(new Carbon($data->check_out))->format('d M Y') : '';
                })
                ->editColumn('in', function ($data) {
                    return $data->check_in ? with(new Carbon($data->check_in))->format('H:i') : '';
                })
                ->editColumn('out', function ($data) {
                    return $data->check_out ? with(new Carbon($data->check_out))->format('H:i') : '';
                })
                ->addColumn('hours', function ($data) {
                    $t1 = Carbon::parse($data->check_in);
                    $t2 = Carbon::parse($data->check_out);
                    $diff = $t1->diff($t2);
                    return $diff->h . " hours " . $diff->i . " minutes";
                })

                ->rawColumns(['hours'])
                ->removeColumn('id')
                ->make(true);
        }
        return view('attendance');
    }

    public function attendance(Request $request)
    {
        if ($request->ajax()) {
            $data = Attendance::with(['employee' => function ($query) {
                $query->select('id', 'fullname', 'position');
            }])
                ->where('employee_id', '=', Auth()->user()->employee_id)
                ->whereMonth('check_in', '=', '08')
                ->get();

            return Datatables::of($data)
                ->editColumn('date', function ($data) {
                    return $data->check_out ? with(new Carbon($data->check_out))->format('d M Y') : '';
                })
                ->editColumn('in', function ($data) {
                    return $data->check_in ? with(new Carbon($data->check_in))->format('H:i') : '';
                })
                ->editColumn('out', function ($data) {
                    return $data->check_out ? with(new Carbon($data->check_out))->format('H:i') : '';
                })
                ->addColumn('hours', function ($data) {
                    $t1 = Carbon::parse($data->check_in);
                    $t2 = Carbon::parse($data->check_out);
                    $diff = $t1->diff($t2);
                    return $diff->h . " hours " . $diff->i . " minutes";
                })

                ->rawColumns(['hours'])
                ->removeColumn('id')
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }

    public function export()
    {
        return Excel::download(new ExportAttendance, 'attendance.xlsx');
    }

    public function import()
    {
        Excel::import(new ImportAttendance, request()->file('file'));

        return back()->with('success', 'Data added Successfully');
    }
}

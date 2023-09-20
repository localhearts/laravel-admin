<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if (Auth::user()->roles == '1') {
            if ($request->ajax()) {

                $data = Report::with(['employee' => function ($query) {
                    $query->select('id', 'fullname');
                    
                }])
                    ->with(['task' => function ($query) {
                        $query->select('id', 'task');
                    }])
                    ->get();


                return Datatables::of($data)->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="/daily/' . $row->id . '" class="btn btn-primary btn-sm">V</a> <a href="/tasks/' . $row->id . '/edit" class="btn btn-warning btn-sm">E</a> <form action="/daily/' . $row->id . '" method="POST" style="display: inline-block;">
                     <input type="hidden" name="_method" value="DELETE">
                     <input type="hidden" name="_token" value="' . csrf_token() . '">
                     <button type="submit" class="btn btn-danger btn-sm">D</button>
                 </form>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('reports.index');
        } else {
            if ($request->ajax()) {

                $data = Report::with(['employee' => function ($query) {
                    $query->select('id', 'fullname');
                    
                }])
                    ->with(['task' => function ($query) {
                        $query->select('id', 'task');
                    }])
                    ->where('employee_id', Auth::user()->employee_id)
                    ->get();


                return Datatables::of($data)->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="/daily/' . $row->id . '" class="btn btn-primary btn-sm">V</a> <a href="/tasks/' . $row->id . '/edit" class="btn btn-warning btn-sm">E</a> <form action="/daily/' . $row->id . '" method="POST" style="display: inline-block;">
                     <input type="hidden" name="_method" value="DELETE">
                     <input type="hidden" name="_token" value="' . csrf_token() . '">
                     <button type="submit" class="btn btn-danger btn-sm">D</button>
                 </form>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('reports.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $task = Task::where('status', '0')->where('employee_id', Auth::user()->employee_id)->get();

        return view('reports.create', compact('task'));
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
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        $emp = Auth::user()->employee_id;
        $imageName = time() . '.' . $request->image->extension();

        $request->image->move(public_path('images'), $imageName);

        $data = Report::create([
            'employee_id' => $emp,
            'capture' => $imageName,
            'task_id' => $request->task_id,
            'description' => $request->description,
        ]);
        return redirect()->route('daily.index')->with('success', 'Report Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $daily)
    {
        $task = Task::find($daily->task_id);
        return view('reports.show', compact('daily', 'task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $daily)
    {
        unlink(public_path('images') . '/' . $daily->capture);

        $daily->delete();
        return redirect()->route('daily.index')->with('success', 'Report Deleted Successfully');
    }
}

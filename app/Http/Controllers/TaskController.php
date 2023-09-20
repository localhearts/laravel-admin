<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        if (Auth::user()->roles == '1') {
            if ($request->ajax()) {

                $data = Task::with(['employee' => function ($query) {
                    $query->select('id', 'fullname');
                }])
                    ->get();
                return Datatables::of($data)->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="/tasks/' . $row->id . '" class="btn btn-primary btn-sm">V</a> <a href="/tasks/' . $row->id . '/edit" class="btn btn-warning btn-sm">E</a> <form action="/tasks/' . $row->id . '" method="POST" style="display: inline-block;">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <button type="submit" class="btn btn-danger btn-sm">D</button>
                </form>';
                        return $btn;
                    })
                    ->editColumn('start_date', function ($data) {
                        return $data->start_date ? with(new Carbon($data->start_date))->format('d M Y') : '';
                    })
                    ->editColumn('end_date', function ($data) {
                        return $data->end_date ? with(new Carbon($data->end_date))->format('d M Y') : '';
                    })
                    ->editColumn('status', function ($data) {
                        return  $data->status == 0 ? 'Start' : ($data->status == 1 ? 'Pending' : 'Finished');
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }

            return view('tasks.index');
        } else {

            if ($request->ajax()) {

                $data = Task::with(['employee' => function ($query) {
                    $query->select('id', 'fullname');
                }])
                    ->where('employee_id', Auth::user()->employee_id)
                    ->get();
                return Datatables::of($data)->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="/tasks/' . $row->id . '" class="btn btn-primary btn-sm">V</a> <a href="/tasks/' . $row->id . '/edit" class="btn btn-warning btn-sm">E</a> <form action="/tasks/' . $row->id . '" method="POST" style="display: inline-block;">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <button type="submit" class="btn btn-danger btn-sm">D</button>
                </form>';
                        return $btn;
                    })
                    ->editColumn('start_date', function ($data) {
                        return $data->start_date ? with(new Carbon($data->start_date))->format('d M Y') : '';
                    })
                    ->editColumn('end_date', function ($data) {
                        return $data->end_date ? with(new Carbon($data->end_date))->format('d M Y') : '';
                    })
                    ->editColumn('status', function ($data) {
                        return  $data->status == 0 ? 'Start' : ($data->status == 1 ? 'Pending' : 'Finished');
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }

            return view('tasks.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->roles != '1'){
            return abort(404);
        }

        $emp = Employee::all();

        return view('tasks.create', compact('emp'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $start = str_replace('/', '-', $request->start);
        $end = str_replace('/', '-', $request->end);
        $start_date = date('Y-m-d', strtotime($start));
        $end_date = date('Y-m-d', strtotime($end));

        Task::create([
            'task' => $request->taskname,
            'status' => $request->status,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'employee_id' => $request->employee,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task Created Successfully');

        // Eloquent Store Data

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $task = Task::find($task->id);
        if($task->employee_id != Auth::user()->employee_id){
            return abort(404);
        }
        $emp = Employee::all();

        return view('tasks.show', compact('task', 'emp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
       
        $task = Task::find($task->id);
        
        if($task->employee_id != Auth::user()->employee_id){
            return abort(404);
        }
        $emp = Employee::all();

        return view('tasks.edit', compact('task', 'emp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $start = str_replace('/', '-', $request->start);
        $end = str_replace('/', '-', $request->end);
        $start_date = date('Y-m-d', strtotime($start));
        $end_date = date('Y-m-d', strtotime($end));

        // dd($request->all());

        $task->update([
            'task'     => $request->taskname,
            'status'   => $request->status,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'employee_id' => $request->employee,
        ]);
        return redirect()->route('tasks.index')->with(['success' => 'Task Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        //redirect to index
        return redirect()->route('tasks.index')->with(['success' => 'Task Deleted Successfully']);
    }
}

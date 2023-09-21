<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class UserController extends Controller
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
        if (Auth::user()->roles != '1') {
            return abort(404);
        }

        if ($request->ajax()) {
            $data = User::with(['employee' => function ($query) {
                $query->select('id', 'fullname', 'position');
            }])->get();

            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="/user-management/' . $row->id . '/edit" class="btn btn-warning btn-sm">E</a> <form action="/user-management/' . $row->id . '" method="POST" style="display: inline-block;">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <button type="submit" class="btn btn-danger btn-sm">D</button>
                    </form>';
                    return $btn;
                })
                ->editColumn('roles', function ($data) {
                    return  $data->roles == 1 ? 'SUPER ADMIN' : 'MEMBER';
                })
                ->editColumn('status', function ($data) {
                    return  $data->status == 1 ? 'ACTIVE' : 'DEAD ACTIVE';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->roles != '1') {
            return abort(404);
        }

        $emp = Employee::all();

        return view('users.create', compact('emp'));
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
        if (Auth::user()->roles != '1') {
            return abort(404);
        }
        $this->validate($request, [
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:users,email',
            'password' => 'required',
            'employee' => 'required|unique:users,employee_id',
            'roles' => 'required',
        ]);

        $user = new User;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->employee_id = $request->employee;
        $user->roles = $request->roles;
        $user->status = '1';
        $user->save();

        return redirect()->route('user-management.create')->with('success', 'User Created Successfully');


        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user_management)
    {
        if (Auth::user()->roles != '1') {
            return abort(404);
        }
        dd($user_management);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user_management)
    {
        if (Auth::user()->roles != '1') {
            return abort(404);
        }
        
        $emp = Employee::all();

        return view('users.edit', compact('user_management', 'emp'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user_management)
    {
        if (Auth::user()->roles != '1') {
            return abort(404);
        }

        $this->validate($request, [
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:users,email,' . $user_management->id,
            'employee' => 'required|unique:users,employee_id,' . $user_management->id,
            'roles' => 'required',
        ]);

        $user_management->update([
            'email' => $request->email,
            'employee_id' => $request->employee,
            'roles' => $request->roles,
        ]);

        return redirect()->route('user-management.index')->with('success', 'User Updated Successfully');

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user_management)
    {
        if (Auth::user()->roles != '1') {
            return abort(404);
        }
        
        $user_management->delete();

        return redirect()->route('user-management.index')->with('success', 'User Deleted Successfully');
        //
    }
}

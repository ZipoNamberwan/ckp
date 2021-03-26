<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\EmployeeData;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        //$this->middleware('role:supervisor|admin');
        $this->middleware('role:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $department = Auth::user()->department;
        $users = $department->getAllChildrenUsers();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $department = Auth::user()->department;

        $departments = $department->getAllChildrenDepartment();
        $users = User::where('id', '!=', '1')->get();
        $employees = EmployeeData::all();

        return view('user.create', compact('departments', 'users', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee' => 'required',
            'email' => 'required|email',
            'department' => 'required',
            'password' => 'required|confirmed|min:6',
            'assessor' => 'required',
            'role' => 'required',
        ]);

        $employee = EmployeeData::find($request->employee);
        $user = User::create([
            'email' => $request->email,
            'department_id' => $request->department,
            'password' => bcrypt($request->password),
            'assessor_id' => $request->assessor,
            'name' => $employee->nama,
            'nip' => $employee->nipbaru,
            'nipold' => strval($employee->nip),
        ]);

        $user->assignRole($request->role);

        return redirect('/users')->with('success-create', 'User telah ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $department = Auth::user()->department;

        $departments = $department->getAllChildrenDepartment();
        $users = User::where('id', '!=', '1')->get();
        $employees = EmployeeData::all();

        return view('user.edit', compact('departments', 'departments', 'user', 'users', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validationArray = array(
            'employee' => 'required',
            'email' => 'required|email',
            'department' => 'required',
            'assessor' => 'required',
            'role' => 'required',
        );

        $employee = EmployeeData::find($request->employee);

        if ($request->changepassword) {
            $validationArray['password'] = 'required|confirmed|min:6';
        }

        $request->validate($validationArray);

        $updateArray = array(
            'email' => $request->email,
            'department_id' => $request->department,
            'assessor_id' => $request->assessor,
            'name' => $employee->nama,
            'nip' => $employee->nipbaru,
            'nipold' => strval($employee->nip),
        );

        if ($request->changepassword) {
            $updateArray['password'] = bcrypt($request->password);
        }

        $user->update($updateArray);

        $user->syncRoles($request->role);

        return redirect('/users')->with('success-edit', 'Data User telah diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/users')->with('success-delete', 'Data User telah dihapus!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $department = Auth::user()->department;
        $users = collect();
        foreach ($department->allchildren as $bidang) {
            $users = $users->merge($bidang->users);
            if ($bidang->allchildren) {
                foreach ($bidang->allchildren as $seksi) {
                    $users = $users->merge($seksi->users);
                }
            }
        }
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

        $departments = collect();
        foreach ($department->allchildren as $bidang) {
            $departments->push($bidang);
            if ($bidang->allchildren) {
                foreach ($bidang->allchildren as $seksi) {
                    $departments->push($seksi);
                }
            }
        }

        return view('user.create', compact('departments'));
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
            'name' => 'required',
            'email' => 'required|email',
            'department' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'department_id' => $request->department,
            'password' => bcrypt($request->password)
        ]);

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

        $departments = collect();
        foreach ($department->allchildren as $bidang) {
            $departments->push($bidang);
            if ($bidang->allchildren) {
                foreach ($bidang->allchildren as $seksi) {
                    $departments->push($seksi);
                }
            }
        }

        return view('user.edit', compact('departments', 'departments', 'user'));
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
            'name' => 'required',
            'email' => 'required|email',
            'department' => 'required'
        );

        if ($request->changepassword) {
            $validationArray['password'] = 'required|confirmed|min:6';
        }

        $request->validate($validationArray);

        $updateArray = array(
            'name' => $request->name,
            'email' => $request->email,
            'department_id' => $request->department,
        );

        if ($request->changepassword) {
            $updateArray['password'] = bcrypt($request->password);
        }

        $user->update($updateArray);

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

<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $department = Auth::user()->department;

        $relateddept = [];
        $users = [];
        foreach ($department->allchildren as $bidang) {
            $relateddept[] = $bidang;
            array_push($users, User::where(['department_id' => $bidang->id])->get());
            if ($bidang->allchildren) {
                foreach ($bidang->allchildren as $seksi) {
                    $relateddept[] = $seksi;
                    array_push($users, User::where(['department_id' => $seksi->id])->get());
                    dd(User::where(['department_id' => $seksi->id])->get());
                }
            }
        }

        dd($users);
        return view('monitoring.index');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Ckp;
use App\Models\Department;
use App\Models\Month;
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

        $months = Month::all();
        $users = collect();
        foreach ($department->allchildren as $bidang) {
            $users = $users->merge($bidang->users);
            if ($bidang->allchildren) {
                foreach ($bidang->allchildren as $seksi) {
                    $users = $users->merge($seksi->users);
                }
            }
        }

        $statuses = collect();

        foreach ($users as $user) {
            $statuses = $statuses->merge([Ckp::where(['user_id' => $user->id, 'year_id' => '1'])->orderBy('month_id', 'ASC')->get()]);
        }

        //dd($statuses[0][0]->statuses->name_1);

        return view('monitoring.index', compact(['months', 'users', 'statuses']));
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

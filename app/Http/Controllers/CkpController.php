<?php

namespace App\Http\Controllers;

use App\Models\ActivityCkp;
use App\Models\Ckp;
use App\Models\Month;
use App\Models\Year;
use Auth;
use Illuminate\Http\Request;

class CkpController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $months = Month::all();
        $years = Year::all();
        $currentyear = Year::firstWhere('name', date("Y"));

        foreach ($months as $month) {
            Ckp::firstOrCreate(
                [
                    'user_id' => $user->id,
                    'year_id' => $currentyear->id,
                    'month_id' => $month->id,
                ],
                [
                    'status_id' => '1'
                ]
            );
        }

        $ckps = Ckp::where(['user_id' => $user->id, 'year_id' => $currentyear->id])->orderBy('month_id', 'asc')->get();

        return view('ckp.index', compact('ckps', 'months', 'currentyear', 'years'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
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
    public function edit(Ckp $ckp)
    {
        if (Auth::user()->id != $ckp->user->id) {
            abort(403);
        }
        return view('ckp.entrickp', compact('ckp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ckp $ckp)
    {
        if ($request->issend == "1") {
            $request->validate([
                'activityname.*' => 'required',
                'activityunit.*' => 'required',
                'activitytarget.*' => 'required',
                'activityreal.*' => 'required',
                'activitynote.*' => 'required',
            ]);
        }

        dd($request->issend);
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

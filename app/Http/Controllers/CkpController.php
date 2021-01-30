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

        if ($request->removedactivity) {
            ActivityCkp::whereIn('id', $request->removedactivity)->delete();
        }

        for ($i = 0; $i < count($request->activityname); $i++) {
            $activity = new ActivityCkp;
            if ($request->activityid[$i]) {
                $activity = ActivityCkp::find($request->activityid[$i]);
            }
            $activity->type = $request->activitytype[$i];
            $activity->name = $request->activityname[$i];
            $activity->unit = $request->activityunit[$i];
            $activity->target = $request->activitytarget[$i];
            $activity->real = $request->activityreal[$i];
            $activity->note = $request->activitynote[$i];
            $activity->ckp_id = $ckp->id;
            $activity->save();
        }

        if ($request->issend == "1") {
            $request->validate([
                'activityname.*' => 'required',
                'activityunit.*' => 'required',
                'activitytarget.*' => 'required',
                'activityreal.*' => 'required',
            ]);
            $ckp->status_id = '3';
            $ckp->save();
        } else {
            $ckp->status_id = '2';
            $ckp->save();
        }

        if ($request->issend == "1") {
            return redirect('/ckps')->with('success-send', 'CKP sudah dikirim dan sedang dalam proses penilaian!');
        } else {
            return redirect('/ckps/' . $ckp->id . '/edit')->with('success-save', 'CKP sudah disimpan!');
        }
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

    public function deleteAllActivities(Request $request)
    {
        $ckp = Ckp::find($request->id);
        if ($ckp->status_id != '1' || $ckp->status_id != '1') {
            ActivityCkp::where('ckp_id', $ckp->id)->delete();
            $ckp->status_id = '1';
            $ckp->save();
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
}

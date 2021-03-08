<?php

namespace App\Http\Controllers;

use App\Models\ActivityCkpR;
use App\Models\ActivityCkpT;
use App\Models\Ckp;
use App\Models\Month;
use App\Models\SubmittedCkp;
use App\Models\User;
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

        if ($currentyear == null) {
            $currentyear = Year::all()->last();
        }

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

    public function ckpByYear($year)
    {
        $user = Auth::user();
        $months = Month::all();
        $years = Year::all();
        $currentyear = Year::find($year);

        if ($currentyear == null) {
            $currentyear = Year::all()->last();
        }

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
    // public function create(Request $request)
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ckp $ckp)
    {
        $department = Auth::user()->department;
        $users = $department->getAllChildrenUsers();
        $isallowed = false;
        foreach ($users as $user) {
            if ($user->id == $ckp->user->id) {
                $isallowed = true;
                break;
            }
        }
        if (!$isallowed) {
            abort(403);
        }
        return view('ckp.view', compact('ckp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editCkpT(Ckp $ckp)
    {
        if (Auth::user()->id != $ckp->user->id) abort(403);


        return view('ckp.entrickpt', compact('ckp'));
    }

    public function editCkpR(Ckp $ckp)
    {
        if ($ckp->status->id < 3) abort(404);

        if (Auth::user()->id != $ckp->user->id) abort(403);

        if (count($ckp->activitiesR) == 0) {
            foreach ($ckp->activitiesT as $activityT) {
                $activityR = new ActivityCkpR();
                $activityR->type = $activityT->type;
                $activityR->name = $activityT->name;
                $activityR->unit = $activityT->unit;
                $activityR->target = $activityT->target;
                $activityR->note = $activityT->note;
                $activityR->credit = $activityT->credit;
                $activityR->quality = '100';
                $activityR->ckp_id = $ckp->id;
                $activityR->save();
            }
        }
        $ckp = $ckp->fresh();

        return view('ckp.entrickpr', compact('ckp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCkpR(Request $request, Ckp $ckp)
    {
        if ($request->issend == "1") {
            $request->validate([
                'activityname.*' => 'required',
                'activityunit.*' => 'required',
                'activitytarget.*' => 'required|numeric|min:0',
                'activityreal.*' => 'required|numeric|min:0',
            ]);

            $ckp->status_id = '5';
            $ckp->note = null;
            $ckp->save();

            $submittedckp = new SubmittedCkp;
            $submittedckp->assessor_id = User::where('department_id', $ckp->user->department->parent->id)->first()->id;
            $submittedckp->ckp_id = $ckp->id;
            $submittedckp->status_id = '5';
            $submittedckp->save();
        } else {
            $ckp->status_id = '4';
            $ckp->note = null;
            $ckp->save();
            if ($request->issendcancel == "1") {
                $submittedCkps = SubmittedCkp::where(['status_id' => '5', 'ckp_id' => $ckp->id])->get();
                foreach ($submittedCkps as $submittedCkp) {
                    $submittedCkp->delete();
                }
                return redirect('/ckps/ckpr/' . $ckp->id . '/edit')->with('success-send', 'CKP ' . $ckp->month->name . ' ' . $ckp->year->name . ' sudah siap untuk diperbaiki');
            }
        }

        if ($request->removedactivity) {
            ActivityCkpR::whereIn('id', $request->removedactivity)->delete();
        }

        for ($i = 0; $i < count($request->activityname); $i++) {
            $activity = new ActivityCkpR();
            if ($request->activityid[$i]) {
                $activity = ActivityCkpR::find($request->activityid[$i]);
            }
            $activity->type = $request->activitytype[$i];
            $activity->name = $request->activityname[$i];
            $activity->unit = $request->activityunit[$i];
            $activity->target = $request->activitytarget[$i];
            $activity->real = $request->activityreal[$i];
            $activity->note = $request->activitynote[$i];
            $activity->credit = $request->activitycredit[$i];
            $activity->quality = '100';
            $activity->ckp_id = $ckp->id;
            $activity->save();
        }

        if ($request->issend == "1") {
            return redirect('/ckps')->with('success-send', 'CKP sudah dikirim dan sedang dalam proses penilaian!');
        } else {
            return redirect('/ckps/ckpr/' . $ckp->id . '/edit')->with('success-save', 'CKP-R sudah disimpan!');
        }
    }

    public function updateCkpT(Request $request, Ckp $ckp)
    {
        if ($request->issend == "1") {
            $request->validate([
                'activityname.*' => 'required',
                'activityunit.*' => 'required',
                'activitytarget.*' => 'required|numeric|min:0',
            ]);

            $ckp->status_id = '3';
            $ckp->save();
        } else {
            $ckp->status_id = '2';
            $ckp->save();
            if ($request->isfix == "1") {
                return redirect('/ckps/ckpt/' . $ckp->id . '/edit')->with('success-send', 'CKP ' . $ckp->month->name . ' ' . $ckp->year->name . ' sudah siap untuk diperbaiki');
            }
        }

        if ($request->removedactivity) {
            ActivityCkpT::whereIn('id', $request->removedactivity)->delete();
        }

        for ($i = 0; $i < count($request->activityname); $i++) {
            $activity = new ActivityCkpT();
            if ($request->activityid[$i]) {
                $activity = ActivityCkpT::find($request->activityid[$i]);
            }
            $activity->type = $request->activitytype[$i];
            $activity->name = $request->activityname[$i];
            $activity->unit = $request->activityunit[$i];
            $activity->target = $request->activitytarget[$i];
            $activity->note = $request->activitynote[$i];
            $activity->credit = $request->activitycredit[$i];
            $activity->ckp_id = $ckp->id;
            $activity->save();
        }

        if ($request->issend == "1") {
            return redirect('/ckps')->with('success-send', 'CKP-T ' . $ckp->month->name . ' ' . $ckp->year->name . ' sudah final. Entri CKP-R sudah bisa dilakukan');
        } else {
            return redirect('/ckps/ckpt/' . $ckp->id . '/edit')->with('success-save', 'CKP-T sudah disimpan!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     //
    // }

    // public function deleteAllActivities(Request $request)
    // {
    //     $ckp = Ckp::find($request->id);
    //     if ($ckp->status_id != '5') {
    //         ActivityCkpR::where('ckp_id', $ckp->id)->delete();
    //         $ckp->status_id = '1';
    //         $ckp->save();
    //         $submittedCkps = SubmittedCkp::where(['status_id' => '3', 'ckp_id' => $ckp->id])->get();
    //         foreach ($submittedCkps as $submittedCkp) {
    //             $submittedCkp->delete();
    //         }
    //         $status = array(
    //             'issuccess' => true,
    //             'message' => 'Semua Kegiatan Berhasil Dihapus'
    //         );
    //         return response()->json($status);
    //     } else {
    //         $status = array(
    //             'issuccess' => false,
    //             'message' => 'CKP yang Sudah Dinilai Tidak Bisa Dihapus'
    //         );
    //         return response()->json($status);
    //     }
    // }
}

<?php

namespace App\Http\Controllers;

use App\Models\ActivityCkp;
use App\Models\SubmittedCkp;
use Auth;
use Illuminate\Http\Request;

class RatingController extends Controller
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
        $submittedckps = SubmittedCkp::where('assessor_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        return view('assess.index', compact('submittedckps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
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
    public function edit(SubmittedCkp $rating)
    {
        if ($rating->assessor->id != Auth::user()->id) {
            abort(403);
        }

        $ckp = $rating;

        $activities = $rating->ckp->activities;

        return view('assess.entrickp', compact('activities', 'ckp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubmittedCkp $rating)
    {
        if ($request->isapprove == "1") {
            $request->validate([
                'activityquality.*' => 'required|numeric|max:100|min:0',
            ]);

            for ($i = 0; $i < count($request->activityid); $i++) {
                $activity = ActivityCkp::find($request->activityid[$i]);
                $activity->quality = $request->activityquality[$i];
                $activity->save();
            }

            $ckp = $rating->ckp;
            $ckp->status_id = "5";
            $rating->status_id = "5";
            $ckp->save();
            $rating->save();

            return redirect('/ratings')->with(
                'success-approve',
                'CKP ' . $rating->ckp->user->name . ' ' . $rating->ckp->month->name . ' '
                    . $rating->ckp->year->name . ' sudah disetujui!'
            );
        } else {
            $ckp = $rating->ckp;
            $ckp->status_id = "4";
            $rating->status_id = "4";
            $ckp->save();
            $rating->save();

            return redirect('/ratings')->with(
                'success-reject',
                'CKP ' . $rating->ckp->user->name . ' ' . $rating->ckp->month->name . ' '
                    . $rating->ckp->year->name . ' sudah ditolak!'
            );
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
}

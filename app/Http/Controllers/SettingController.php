<?php

namespace App\Http\Controllers;

use App\Models\Year;
use Exception;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $years = Year::all();
        return view('setting.index', compact('years'));
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

    public function createYear()
    {
        return view('setting.createyear');
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

    public function storeYear(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Year::create([
            'name' => $request->name,
        ]);

        return redirect('/settings')->with('success-create', 'Periode Tahun telah ditambah!');
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

    public function editYear(Year $year)
    {
        return view('setting.edityear', compact('year'));
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

    public function updateYear(Request $request, Year $year)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $year->update([
            'name' => $request->name,
        ]);

        return redirect('/settings')->with('success-create', 'Periode Tahun telah diubah!');
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

    public function destroyYear(Year $year)
    {
        try {
            $year->delete();
            return redirect('/years')->with('success-delete', 'Unit Kerja telah dihapus!');
        } catch (Exception $e) {
            $message = "";
            if ($e->getCode() == "23000") {
                // $message = "Gagal menghapus Periode Tahun. Ada User yang menggunakan Periode Tahun " . $year->name . " atau Ada Periode Tahun di bawah " . $year->name;
                $message = "Gagal menghapus Periode Tahun";
            } else if ($e->getCode() == "0") {
                $message = "Gagal menghapus Periode Tahun. Periode Tahun " . $year->name . " tidak ada";
            } else {
                $message = "Gagal menghapus Periode Tahun";
            }
            return redirect('/settings')->with('error-delete', $message);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\DataPegawai;
use App\Models\Organization;
use Exception;
use Illuminate\Http\Request;

class OrganizationController extends Controller
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
        $organization = Organization::find(1);
        $organizations = $organization->getAllChildrenOrganizations();
        return view('organization.index', compact('organizations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $organization = Organization::find(1);
        $organizations = $organization->getAllChildrenOrganizations();
        return view('organization.create', compact('organizations'));
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
            'organization' => 'required',
        ]);

        Organization::create([
            'name' => $request->name,
            'parent_id' => $request->organization,
            'position' => 0,
        ]);

        return redirect('/organizations')->with('success-create', 'Unit Kerja telah ditambah!');
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
    public function edit(Organization $organization)
    {
        $rootorganization = Organization::find(1);
        $organizations = $rootorganization->getAllChildrenOrganizations();
        return view('organization.edit', compact('organizations', 'organization'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organization $organization)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $organization->update([
            'name' => $request->name,
        ]);

        return redirect('/organizations')->with('success-edit', 'Unit Kerja telah diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        try {
            $result = $organization->delete();
            return redirect('/organizations')->with('success-delete', 'Jenjang Jabatan telah dihapus!');
        } catch (Exception $e) {
            $message = "";
            if ($e->getCode() == "23000") {
                // $message = "Gagal menghapus Jenjang Jabatan. Ada User yang menggunakan Jenjang Jabatan " . $organization->name . " atau Ada Jenjang Jabatan di bawah " . $organization->name;
                $message = "Gagal menghapus Jenjang Jabatan";
            } else if ($e->getCode() == "0") {
                $message = "Gagal menghapus Jenjang Jabatan. Jenjang Jabatan " . $organization->name . " tidak ada";
            } else {
                $message = "Gagal menghapus Jenjang Jabatan";
            }
            return redirect('/organizations')->with('error-delete', $message);
        }
    }
}

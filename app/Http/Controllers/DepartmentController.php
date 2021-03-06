<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Organization;
use Exception;
use Illuminate\Http\Request;

class DepartmentController extends Controller
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
        $department = Department::find(1);
        $departments = $department->getAllChildrenDepartment();
        return view('department.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $department = Department::find(1);
        $organizations = Organization::find(1)->getAllChildrenOrganizations();
        $departments = $department->getAllChildrenDepartment();
        return view('department.create', compact('departments', 'organizations'));
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
            'department' => 'required',
            'organization' => 'required'
        ]);

        Department::create([
            'name' => $request->name,
            'parent_id' => $request->department,
            'organization_id' => $request->organization,
            'position' => 0,
        ]);

        return redirect('/departments')->with('success-create', 'Jenjang Jabatan telah ditambah!');
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
    public function edit(Department $department)
    {
        $rootdepartment = Department::find(1);
        $organizations = Organization::find(1)->getAllChildrenOrganizations();
        $departments = $rootdepartment->getAllChildrenDepartment();
        return view('department.edit', compact('departments', 'department', 'organizations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required',
            'organization' => 'required',
            'parent' => 'required'
        ]);

        $department->update([
            'name' => $request->name,
            'organization_id' => $request->organization,
            'parent_id' => $request->parent
        ]);

        return redirect('/departments')->with('success-edit', 'Jenjang Jabatan telah diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        try {
            $result = $department->delete();
            return redirect('/departments')->with('success-delete', 'Jenjang Jabatan telah dihapus!');
        } catch (Exception $e) {
            $message = "";
            if ($e->getCode() == "23000") {
                // $message = "Gagal menghapus Jenjang Jabatan. Ada User yang menggunakan Jenjang Jabatan " . $department->name . " atau Ada Jenjang Jabatan di bawah " . $department->name;
                $message = "Gagal menghapus Jenjang Jabatan";
            } else if ($e->getCode() == "0") {
                $message = "Gagal menghapus Jenjang Jabatan. Jenjang Jabatan " . $department->name . " tidak ada";
            } else {
                $message = "Gagal menghapus Jenjang Jabatan";
            }
            return redirect('/departments')->with('error-delete', $message);
        }
    }
}

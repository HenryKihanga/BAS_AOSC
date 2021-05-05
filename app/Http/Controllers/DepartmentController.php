<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organizations = Organization::all();
        $branches = Branch::all();
        $departments = Department::orderBy('updated_at', 'asc')->take(5)->get();
        return view('department.manage')->with([
            'branches' => $branches,
            'organizations' => $organizations,
            'departments' => $departments
        ]);
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
        $request->validate([
            'branchId' => 'required',
            'registrationNumber' => 'required',
            'registrationName' => 'required',
            'phoneNumber' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);

        //fetch parent
        $branch = Branch::find($request->input('branchId'));
        if (!$branch) {
            return response()->json([
                'error' => 'Branch Not Exist,make sure you register branch'
            ]);
        }
        //create new branch
        $department = new Department();
        $department->department_id = $request->input('registrationNumber');
        $department->department_name = $request->input('registrationName');
        $department->department_phone_number = $request->input('phoneNumber');
        $department->department_email = $request->input('email');
        $department->department_address = $request->input('address');
        if ($branch->departments()->save($department)) {
            return redirect()->route('manageDepartment');
            // $newDepartment = Department::find($department->department_id);
            // return response()->json([
            //     'success' => 'success',
            //     'newDepartment' => $newDepartment
            // ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = Department::find($id);
        return view('department.edit')->with([
            'department' => $department
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'registrationNumber' => 'required',
            'registrationName' => 'required',
            'phoneNumber' => 'required',
            'email' => 'required',
            'address' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'status' => false
            ], 404);
        }

        $department = Department::find($request->input('registrationNumber'));
        if (!$department) {
            return response()->json([
                'error' => 'department not found'
            ], 404);
        }

        $department->update([
            'department_name' => $request->input('registrationName'),
            'department_phone_number' => $request->input('phoneNumber'),
            'department_email' => $request->input('email'),
            'department_address' => $request->input('address'),
        ]);

        return redirect()->route('manageDepartment');
        // return response()->json([
        //     'department' => $department
        // ], 206);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        //
    }

    public function showOne($departmentId)
    {
        $department = Department::find($departmentId);
        if (!$department) {
            return response()->json([
                'error' => 'department do not exist'
            ], 404);
        }

        return response()->json([
            'department' => $department
        ], 200);
    }

    public function showAll()
    {
        $departments = Department::all();
        return response()->json([
            'departments' => $departments
        ], 200);
    }
}

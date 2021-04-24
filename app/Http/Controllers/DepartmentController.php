<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
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
        //
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
    public function store(Request $request, $branch_id)
    {
        $validator =  Validator::make($request->all(), [
            'registrationNumber' => 'required',
            'registrationName' => 'required',
            'phoneNumber' => 'required',
            'email' => 'required',
            'address' => 'required',

        ]);

        //check if validator fails
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'status' => false
            ], 404);
        }
        //fetch parent
        $branch = Branch::find($branch_id);
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
            $newDepartment = Department::find($department->department_id);
            return response()->json([
                'success' => 'success',
                'branch' => $newDepartment
            ]);
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
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        //
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
                'error' => 'organization do not exist'
            ], 404);
        }

        return response()->json([
            'organization' => $department
        ], 200);
    }

    public function showAll()
    {
        $departments = Department::all();
        return response()->json([
            'organizations' => $departments
        ], 200);
    }
}

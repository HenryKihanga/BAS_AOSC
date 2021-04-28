<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BranchController extends Controller
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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'organizationId' => 'required',
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
        $organization = Organization::find($request->input('organizationId'));
        if (!$organization) {
            return response()->json([
                'error' => 'Organization Not Exist,make sure you register organization'
            ]);
        }

        //create new branch
        $branch = new Branch();
        $branch->branch_id = $request->input('registrationNumber');
        $branch->branch_name = $request->input('registrationName');
        $branch->branch_phone_number = $request->input('phoneNumber');
        $branch->branch_email = $request->input('email');
        $branch->branch_address = $request->input('address');
        if ($organization->branches()->save($branch)) {
            $newBranch = Branch::find($branch->branch_id);
            return response()->json([
                'success' => 'success',
                'branch' => $newBranch
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Branch  $branch
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

        $branch = Branch::find($request->input('registrationNumber'));
        if (!$branch) {
            return response()->json([
                'error' => 'branch not found'
            ], 404);
        }

        $branch->update([
            'branch_name' => $request->input('registrationName'),
            'branch_phone_number' => $request->input('phoneNumber'),
            'branch_email' => $request->input('email'),
            'branch_address' => $request->input('address'),
        ]);

        return response()->json([
            'branch' => $branch
        ], 206);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        //
    }
    public function showOne($branchId)
    {
        $branch = Branch::find($branchId);
        if (!$branch) {
            return response()->json([
                'error' => 'branch do not exist'
            ], 404);
        }

        $branch->departments;
        return response()->json([
            'branch' => $branch
        ], 200);
    }


    public function showAll()
    {
        $branches = Branch::all();
        foreach ($branches as $branch) {
            $branch->departments;
        }

        return response()->json([
            'branches' => $branches
        ], 200);
    }
}

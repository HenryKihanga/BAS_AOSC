<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
    //     $p = Permintaan::create([
    //         'NOMOR_TICKET' =>$value,
    //         'TGL_PERMINTAAN' =>$value,
    //         'NAMA_REQUESTER' =>$value,
    //     ]);
       
    //    $p->pembatalan()->create([
    //        'ALASAN_PEMBATALAN' =>$value,
    //        'TGL_PEMBATALAN' =>$value,
    //        'FILE_PEMBATALAN' =>$value,
    //        'STATUS_PEMBATALAN' =>$value,
    //     ]);
        $validator =  Validator::make($request->all(), [
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' =>  ['required', 'string', 'max:255'],
            'userID' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phoneNumber' => 'required',
            'birthDate' => 'required',
            'organization' => 'required',
            'branch' => 'required',
            'department' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'status' => false
            ], 404);
        }
        if ($request->input('roles') == null) {
            return response()->json([
                'error' => 'Select atleast one role'
            ]);
        }

        $department = Department::find($request->input('department'));
        $user = new User();
        $user->user_id = $request->input('userID');
        $user->first_name = $request->input('firstName');
        $user->middle_name = $request->input('middleName');
        $user->last_name = $request->input('lastName');
        $user->phone_number = $request->input('phoneNumber');
        $user->birth_date = $request->input('birthDate');
        $user->email = $request->input('email');
        //check if just a staff set password null
        if (count($request->input('roles')) == 1 && $request->input('roles')[0] == 5) {
            $user->password = null;
        } else {
            $user->password = Hash::make(strtoupper($request->input('lastName')));
        }

        //associate roles then save user
        $user->status()->create();
        $user->roles()->sync($request->input('roles'));
        $department->users()->save($user);

        return response()->json([
            'message'=>'success',
            'results' => $user]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function showAll()
    {
        $users = User::all();
        foreach ($users as $user) {
            $user->status;
            $user->roles;
        }
        return response()->json([
            'users' => $users
        ]);
    }
}

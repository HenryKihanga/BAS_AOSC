<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Device;
use App\Models\Organization;
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
        $users = User::orderBy('updated_at', 'asc')->take(5)->get();
        foreach ($users as $user) {
            $user->status;
            $user->roles;
        }
        return view('user.allUsers')->with([
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $organizations = Organization::all();
        $branches = Branch::all();
        $departments = Department::all();
        return view('user.addUser')->with([
            'organizations' => $organizations,
            'branches' => $branches,
            'departments' => $departments
        ]);
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
            'firstName' => ['required', 'string', 'max:255'],
            'middleName' =>  ['required', 'string', 'max:255'],
            'lastName' =>  ['required', 'string', 'max:255'],
            'userID' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phoneNumber' => 'required',
            'birthDate' => 'required',
            'organization' => 'required',
            'branch' => 'required',
            'department' => 'required',
            'roles' => 'required'
        ]);


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

        return redirect('user/AllUser');

        // return response()->json([
        //     'message' => 'success',
        //     'user' => $user
        // ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile($id)
    {
        $user = User::find($id);
        return view('user.profile')->with([
            'user' => $user,
            'roles' => $user->roles
        ]);
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

    public function changePassword(){
        return view('user.changePassword');
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



    public function fingerPrintId($deviceToken)
    {
        $device = Device::find($deviceToken);
        if ($device) {
            $users = $device->users;
            if (count($users) == 0) {
                return "No user has been registered in this device";
            } else {
                foreach ($users as $user) {
                    //check user that has been selected to be enrolled
                    if ($user->status->ready_to_enroll) {
                        return $user->status->fingerprint_id;
                    } else {
                        return 'No user ready for enrollment';
                    }
                }
            }
        } else {
            return "Device not found";
        }
    }

    public function deleteUserEnrolled($deviceToken)
    {
        $device = Device::find($deviceToken);
        if ($device) {
            $users = $device->users;
            if (count($users) == 0) {
                return "No user has been registered in this device";
            } else {
                foreach ($users as $user) {
                    //check user that has been selected to be enrolled
                    if ($user->status->delete_status) {
                        return $user->status->fingerprint_id;
                        //logics to delete user in the system

                    } else {
                        continue;
                    }
                }
            }
        } else {
            return "Device not found";
        }
    }



    public function confirmEnrollment($fingerPrintId, $deviceToken)
    {
        $device = Device::find($deviceToken);
        if ($device) {
            $users = $device->users;
            if (count($users) == 0) {
                return "No user has been registered in this device";
            } else {
                foreach ($users as $user) {
                    //check user that has been selected to be enrolled
                    if ($user->status->fingerprint_id == $fingerPrintId) {
                        $user->status->update([
                            'ready_to_enroll' => 0,
                            'enrollment_status' => 1
                        ]);
                        return "Succesfull Enrolled";
                    } else {
                        return 'No user is read to enroll';
                    }
                }
            }
        } else {
            return "Device not found";
        }
    }
}

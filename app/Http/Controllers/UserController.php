<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Device;
use App\Models\Organization;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($userId)
    {
        if (Gate::allows('isAdmin')) {
            // $users = User::orderBy('updated_at', 'asc')->take(5)->get();
            $users = User::all();
            foreach ($users as $user) {
                $user->status;
                $user->roles;
            }
            return view('user.allUsers')->with([
                'users' => $users
            ]);
        }
        if (Gate::allows('isOrganizationHead')) {
            $organizationId = User::find($userId)->organization_id; //Get organization id of logged in user
            $users = User::where('organization_id', $organizationId)->get();
            return view('user.allUsers')->with([
                'users' => $users
            ]);
        }

        if (Gate::allows('isBranchHead')) {
            $branchId = User::find($userId)->branch_id; //Get branch id of logged in user
            $users = User::where('branch_id', $branchId)->get();
            return view('user.allUsers')->with([
                'users' => $users
            ]);
        }
        if (Gate::allows('isDepartmentHead')) {
            $users =  User::find($userId)->department->users;
            foreach ($users as $user) {
                $user->status;
                $user->roles;
            }
            return view('user.allUsers')->with([
                'users' => $users
            ]);
        }
    }

    public function enrolledUser($userId)
    {
        if (Gate::allows('isAdmin')) {
            // $users = User::orderBy('updated_at', 'asc')->take(5)->get();
            $users = User::all();
            $enrolledUsers = [];
            foreach ($users as $user) {
                if ($user->status->enrollment_status) {
                    array_push($enrolledUsers, $user);
                } else {
                    continue;
                }
            }
            return view('user.allUsers')->with([
                'users' => $enrolledUsers
            ]);
        }
        if (Gate::allows('isOrganizationHead')) {

            $users =  User::find($userId)->organization->users;
            $enrolledUsers = [];
            foreach ($users as $user) {
                if ($user->status->enrollment_status) {
                    array_push($enrolledUsers, $user);
                } else {
                    continue;
                }
            }
            return view('user.allUsers')->with([
                'users' => $enrolledUsers
            ]);
        }

        if (Gate::allows('isBranchHead')) {
            $users =  User::find($userId)->branch->users;
            $enrolledUsers = [];
            foreach ($users as $user) {
                if ($user->status->enrollment_status) {
                    array_push($enrolledUsers, $user);
                } else {
                    continue;
                }
            }
            return view('user.allUsers')->with([
                'users' => $enrolledUsers
            ]);
        }
        if (Gate::allows('isDepartmentHead')) {
            $users =  User::find($userId)->department->users;
            $enrolledUsers = [];
            foreach ($users as $user) {
                if ($user->status->enrollment_status) {
                    array_push($enrolledUsers, $user);
                } else {
                    continue;
                }
            }
            return view('user.allUsers')->with([
                'users' => $enrolledUsers
            ]);
        }
    }

    public function unenrolledUser($userId)
    {
        if (Gate::allows('isAdmin')) {
            // $users = User::orderBy('updated_at', 'asc')->take(5)->get();
            $users = User::all();
            $unenrolledUsers = [];
            foreach ($users as $user) {
                if (!$user->status->enrollment_status) {
                    array_push($unenrolledUsers, $user);
                } else {
                    continue;
                }
            }
            return view('user.allUsers')->with([
                'users' => $unenrolledUsers
            ]);
        }
        if (Gate::allows('isOrganizationHead')) {
            $users =  User::find($userId)->organization->users;
            $unenrolledUsers = [];
            foreach ($users as $user) {
                if (!$user->status->enrollment_status) {
                    array_push($unenrolledUsers, $user);
                } else {
                    continue;
                }
            }
            return view('user.allUsers')->with([
                'users' => $unenrolledUsers
            ]);
        }

        if (Gate::allows('isBranchHead')) {
            $users =  User::find($userId)->branch->users;
            $unenrolledUsers = [];
            foreach ($users as $user) {
                if (!$user->status->enrollment_status) {
                    array_push($unenrolledUsers, $user);
                } else {
                    continue;
                }
            }
            return view('user.allUsers')->with([
                'users' => $unenrolledUsers
            ]);
        }
        if (Gate::allows('isDepartmentHead')) {
            $users =  User::find($userId)->department->users;
            $unenrolledUsers = [];
            foreach ($users as $user) {
                if (!$user->status->enrollment_status) {
                    array_push($unenrolledUsers, $user);
                } else {
                    continue;
                }
            }
            return view('user.allUsers')->with([
                'users' => $unenrolledUsers
            ]);
        }
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
        if (Gate::allows('isAdmin')) {
            $request->validate([
                'firstName' => ['required', 'string', 'max:255'],
                'middleName' =>  ['required', 'string', 'max:255'],
                'lastName' =>  ['required', 'string', 'max:255'],
                'userID' => 'required',
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phoneNumber' => 'required',
                'birthDate' => 'required',
                'organizationId' => 'required',
                'branchId' => 'required',
                'departmentId' => 'required',
                'roles' => 'required'
            ]);
            $organization = Organization::find($request->input('organizationId'));
            $branch = Branch::find($request->input('branchId'));
            $department = Department::find($request->input('departmentId'));
            $user = new User();
            $user->user_id = $request->input('userID');
            $user->first_name = $request->input('firstName');
            $user->organization_id = $request->input('organizationId');
            $user->branch_id = $request->input('branchId');
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
            return redirect()->route('allUsers', Auth::user()->user_id);
        }

        if (Gate::denies('isAdmin')) {
            $request->validate([
                'firstName' => ['required', 'string', 'max:255'],
                'middleName' =>  ['required', 'string', 'max:255'],
                'lastName' =>  ['required', 'string', 'max:255'],
                'userID' => 'required',
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phoneNumber' => 'required',
                'birthDate' => 'required',
                'organizationId' => 'required',
                'branchId' => 'required',
                'departmentId' => 'required',
            ]);


            $organization = Organization::find($request->input('organizationId'));
            $branch = Branch::find($request->input('branchId'));
            $department = Department::find($request->input('departmentId'));
            $user = new User();
            $user->user_id = $request->input('userID');
            $user->first_name = $request->input('firstName');
            $user->organization_id = $request->input('organizationId');
            $user->branch_id = $request->input('branchId');
            $user->middle_name = $request->input('middleName');
            $user->last_name = $request->input('lastName');
            $user->phone_number = $request->input('phoneNumber');
            $user->birth_date = $request->input('birthDate');
            $user->email = $request->input('email');
            $user->password = null;
            $staffRole = Role::where('name', 'staff')->first();

            //associate roles then save user
            $user->status()->create();
            $user->roles()->attach($staffRole);
            $department->users()->save($user);

            return redirect()->route('allUsers', Auth::user()->user_id);
        }
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

    public function details($id)
    {
        $devices = Device::all();
        $user = User::find($id);
        return view('user.details')->with([
            'user' => $user,
            'devices' => $devices
        ]);
    }

    public function fingerprintEnroll(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'userId' => 'required',
            'fingerPrintId' => 'required',
            'deviceId' => 'required',


        ]);

        if ($validator->fails()) {
            return redirect()->route('showUserDetails', $request->input('userId'))
                ->withErrors($validator)
                ->withInput();
        }




        $deviceUsers = Device::find($request->input('deviceId'))->fingerprintUsers;
        foreach ($deviceUsers as $deviceUser) {
            if ($deviceUser->status->ready_to_enroll == 1) {
                $validator->errors()->add('duplicateReadyToEnroll', 'Make sure no user of the selected device is waiting for enrollment');
                return redirect()->route('showUserDetails', $request->input('userId'))
                    ->withErrors($validator)
                    ->withInput();
            } elseif ($deviceUser->status->fingerprint_id == $request->input('fingerPrintId')) {
                $validator->errors()->add('fingerPrintId', 'User with the given Fingerprint ID is detected, Fingerprint ID must be unique on a given device');
                return redirect()->route('showUserDetails', $request->input('userId'))
                    ->withErrors($validator)
                    ->withInput();
            }
            continue;
        }
        $user = User::find($request->input('userId'));
        $user->update([
            'fingerprint_device_token' => $request->input('deviceId')
        ]);
        $user->status()->update([
            'fingerprint_id' => $request->input('fingerPrintId'),
            'ready_to_enroll' => 1
        ]);

        return redirect()->route('showUserDetails', $request->input('userId'));
    }

    public function rfidEnroll(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'userId' => 'required',
            'cardUid' => 'required',
            'deviceId' => 'required',


        ]);

        if ($validator->fails()) {
            return redirect()->route('showUserDetails', $request->input('userId'))
                ->withErrors($validator)
                ->withInput();
        }
        $deviceUsers = Device::find($request->input('deviceId'))->rfidUsers;
        foreach ($deviceUsers as $deviceUser) {
            if ($deviceUser->status->card_uid == $request->input('cardUid')) {
                $validator->errors()->add('cardfound', 'User with the given Card ID is detected, Card ID must be unique on a given device');
                return redirect()->route('showUserDetails', $request->input('userId'))
                    ->withErrors($validator)
                    ->withInput();
            }
            continue;
        }
        $user = User::find($request->input('userId'));
        $user->update([
            'rfid_device_token' => $request->input('deviceId')
        ]);
        //FORGING CHANGE OF DEVICE MODE
        Device::find($request->input('deviceId'))->update([
            'device_mode' => 1
        ]);
        $user->status()->update([
            'card_uid' => $request->input('cardUid'),
            'card_registered' => 1
        ]);

        return redirect()->route('showUserDetails', $request->input('userId'));
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



    public function deleteUser($userId)
    {
        $user = User::findOrFail($userId);
        if (!$userId) {
            return response()->json(['error' => 'user do not exist'], 504);
        }
        $user->status()->update([
            'delete_status' => 1
        ]);
        // $user->delete();

        return redirect()->route('allUsers', Auth::user()->user_id);
    }

    public function showchangePassword()
    {
        return view('user.changePassword');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'currentPassword' => 'required',
            'password' => 'required|confirmed|min:5',
            'password_confirmation' => 'required|min:5',
        ]);
        if (Hash::check($request->input('currentPassword'), Auth::user()->password)) {
            User::find(Auth::user()->user_id)->update(['password' => Hash::make($request->input('password'))]);
            Auth::logout();
            return redirect('/');
        }
    }

    public function showAll()
    {
        $users = User::all();
        foreach ($users as $user) {
            $user->status;
            $user->roles;
            $user->fingerprintDevice;
            $user->rfidDevice;
        }
        return response()->json([
            'users' => $users
        ]);
    }

    public function showOne($id)
    {
        $user = User::find($id);

        $user->status;
        $user->roles;
        foreach ($user->department->branch->organization->branches as $branches) {
            $branches->departments;
        };
        return response()->json([
            'user' => $user
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
                        continue;
                    }
                }
                return 'No user ready for enrollment';
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
                $i = 0;
                foreach ($users as $user) {
                    //check user that has been selected to be enrolled
                    if ($user->status->delete_status) {
                        $user->status()->update([
                            'delete_status' => 0
                        ]);
                        $user->delete();
                        return $user->status->fingerprint_id;
                        //logics to delete user in the system

                    } else {
                        continue;
                    }
                }

                return "No user to delete";
            }
        } else {
            return "Device not found";
        }
    }



    public function confirmEnrollment($fingerPrintId, $deviceToken)
    {
        $device = Device::find($deviceToken);
        if ($device) {
            $users = $device->fingerprintUsers;
            if (count($users) == 0) {
                return "No user has been registered in this device";
            } else {
                foreach ($users as $user) {
                    //check user that has been selected to be enrolled
                    if ($user->status->fingerprint_id == $fingerPrintId && $user->status->ready_to_enroll == 1) {
                        $user->status->update([
                            'ready_to_enroll' => 0,
                            'enrollment_status' => 1
                        ]);
                        return "Succesfull Enrolled";
                        // return redirect()->route('showUserDetails', $user->user_id);
                    } else {
                        continue;
                    }
                }
                return 'No user to confirm';
            }
        } else {
            return "Device not found";
        }
    }




    // EXCELL EXPORT

    public function exportAllUsers()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Device;
use App\Models\Log;
use App\Models\Organization;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($userId)
    {
      
        // $departments = Department::orderBy('created_at', 'desc')->take(5)->get();
        if (Gate::allows('isAdmin')) {
            $today_rfid_logs = Log::where(['date' => date('Y-m-d'), 'log_type' => 'rfid'])->get()->unique('user_id');
            $users = User::all();
            $rooms = Room::all();
            $enrolledUsers = [];
            $unenrolledUsers = [];
            $usersWithCard = [];
            $usersWithoutCard = [];
           
            foreach ($users as $user) {
                //FETCH USER BY STATUS
                if ($user->status->enrollment_status) {
                    array_push($enrolledUsers, $user);
                    if ($user->status->card_registered) {
                        array_push($usersWithCard, $user);
                    } else {
                        array_push($usersWithoutCard, $user);
                    }
                } else {
                    array_push($unenrolledUsers, $user);
                    if ($user->status->card_registered) {
                        array_push($usersWithCard, $user);
                    } else {
                        array_push($usersWithoutCard, $user);
                    }
                }
            }

            $sensitiveLogs = [];
            foreach ($today_rfid_logs as $log) {
                if ($log->device->room->room_security_level == 'SENSITIVE') {
                    array_push($sensitiveLogs, $log);
                };
            }

          


            $usersPresentToday = Log::where(['date' => date('Y-m-d'), 'log_type' => 'fingerprint'])->get(['user_id'])->unique('user_id');
            if (count($enrolledUsers) < 1) {
                $parcentageofPresentUsers = 0;
                $parcentageofabsentUsers = 0;
            } else {
                $parcentageofPresentUsers = round(($usersPresentToday->count() / count($enrolledUsers)) * 100, 2);
                $parcentageofabsentUsers = round(((count($enrolledUsers) - $usersPresentToday->count()) / count($enrolledUsers)) * 100, 2);
            }


            $organizations = Organization::all()->count();
            $branches = Branch::all()->count();
            $departments = Department::all()->count();
            $devices = Device::all()->count();

            return view('dashboard')->with([
                'registeredUsers' => count($users),
                'enrolledUsers' => count($enrolledUsers),
                'unenrolledUsers' => count($unenrolledUsers),
                'usersWithCard' => count($usersWithCard),
                'usersWithoutCard' => count($usersWithoutCard),
                'presentUsers' => $parcentageofPresentUsers,
                'absentUsers' => $parcentageofabsentUsers,
                'registeredOrganizations' => $organizations,
                'registeredBranches' => $branches,
                'registeredDepartments' => $departments,
                'registeredDevices' => $devices,
                'rooms' => count($rooms),
                'sensitiveLogs' => count($sensitiveLogs)

            ]);
        }




        elseif (Gate::allows('isOrganizationHead')) {
            $organizationId = User::find($userId)->organization_id; //Get organization id of logged in user
            $users = User::where('organization_id', $organizationId)->get(); //get all users of the particular organization
            $today_rfid_logs = Log::where(['date' => date('Y-m-d'), 'log_type' => 'rfid'])->get()->unique('user_id');
            $rooms = Room::all();
            $enrolledUsers = [];
            $unenrolledUsers = [];
            $usersWithCard = [];
            $usersWithoutCard = [];

            foreach ($users as $user) {
                if ($user->status->enrollment_status) {
                    array_push($enrolledUsers, $user);
                    if ($user->status->card_registered) {
                        array_push($usersWithCard, $user);
                    } else {
                        array_push($usersWithoutCard, $user);
                    }
                } else {
                    array_push($unenrolledUsers, $user);
                    if ($user->status->card_registered) {
                        array_push($usersWithCard, $user);
                    } else {
                        array_push($usersWithoutCard, $user);
                    }
                }
            }

            $sensitiveLogs = [];
            foreach ($today_rfid_logs as $log) {
                if ($log->device->room->room_security_level == 'SENSITIVE') {
                    array_push($sensitiveLogs, $log);
                };
            }
  
            $todayLogs = Log::where('date', date('Y-m-d'))->get(['user_id'])->unique('user_id');
            if (count($enrolledUsers) < 1) {
                $parcentageofPresentUsers = 0;
                $parcentageofabsentUsers = 0;
            } else {
                $parcentageofPresentUsers = round(($todayLogs->count() / count($enrolledUsers)) * 100, 2);
                $parcentageofabsentUsers = round(((count($enrolledUsers) - $todayLogs->count()) / count($enrolledUsers)) * 100, 2);
            }

            $organizations = Organization::all()->count();
            $branches = Branch::all()->count();
            $departments = Department::all()->count();
            $devices = Device::where('organization_id', $organizationId)->count();
            // $departments = Department::orderBy('created_at', 'desc')->take(5)->get();
            return view('dashboard')->with([
                'registeredUsers' => count($users),
                'enrolledUsers' => count($enrolledUsers),
                'unenrolledUsers' => count($unenrolledUsers),
                'presentUsers' => $parcentageofPresentUsers,
                'absentUsers' => $parcentageofabsentUsers,
                'registeredOrganizations' => $organizations,
                'registeredBranches' => $branches,
                'registeredDepartments' => $departments,
                'registeredDevices' => $devices,
                'rooms' => count($rooms),
                'sensitiveLogs' => count($sensitiveLogs),
                'usersWithCard' => count($usersWithCard),
                'usersWithoutCard' => count($usersWithoutCard)
            ]);
        }


        elseif (Gate::allows('isBranchHead')) {
            $branchId = User::find($userId)->branch_id; //Get branch id of logged in user
            $users = User::where('branch_id', $branchId)->get(); //get all users of the particular branch
            $today_rfid_logs = Log::where(['date' => date('Y-m-d'), 'log_type' => 'rfid'])->get()->unique('user_id');
            $rooms = Room::all();
            $enrolledUsers = [];
            $unenrolledUsers = [];
            $usersWithCard = [];
            $usersWithoutCard = [];
           

            foreach ($users as $user) {
                if ($user->status->enrollment_status) {
                    array_push($enrolledUsers, $user);
                    if ($user->status->card_registered) {
                        array_push($usersWithCard, $user);
                    } else {
                        array_push($usersWithoutCard, $user);
                    }
                } else {
                    array_push($unenrolledUsers, $user);
                    if ($user->status->card_registered) {
                        array_push($usersWithCard, $user);
                    } else {
                        array_push($usersWithoutCard, $user);
                    }
                }
            }
          
            $todayLogs = Log::where('date', date('Y-m-d'))->get(['user_id'])->unique('user_id');
            if (count($enrolledUsers) < 1) {
                $parcentageofPresentUsers = 0;
                $parcentageofabsentUsers = 0;
            } else {
                $parcentageofPresentUsers = round(($todayLogs->count() / count($enrolledUsers)) * 100, 2);
                $parcentageofabsentUsers = round(((count($enrolledUsers) - $todayLogs->count()) / count($enrolledUsers)) * 100, 2);
            }
            $sensitiveLogs = [];
            foreach ($today_rfid_logs as $log) {
                if ($log->device->room->room_security_level == 'SENSITIVE') {
                    array_push($sensitiveLogs, $log);
                };
            }

            $organizations = Organization::all()->count();
            $branches = Branch::all()->count();
            $departments = Department::all()->count();
            $devices = Device::where('organization_id', $branchId)->count();
            // $departments = Department::orderBy('created_at', 'desc')->take(5)->get();
            return view('dashboard')->with([
                'registeredUsers' => count($users),
                'enrolledUsers' => count($enrolledUsers),
                'unenrolledUsers' => count($unenrolledUsers),
                'presentUsers' => $parcentageofPresentUsers,
                'absentUsers' => $parcentageofabsentUsers,
                'registeredOrganizations' => $organizations,
                'registeredBranches' => $branches,
                'registeredDepartments' => $departments,
                'registeredDevices' => $devices,
                'rooms' => count($rooms),
                'sensitiveLogs' => count($sensitiveLogs),
                'usersWithCard' => count($usersWithCard),
                'usersWithoutCard' => count($usersWithoutCard)
            ]);
        }
        elseif (Gate::allows('isDepartmentHead')) {
            $departmentId = User::find($userId)->department_id; //Get department id of logged in user
            $users = User::where('department_id', $departmentId)->get(); //get all users of the particular department
            $today_rfid_logs = Log::where(['date' => date('Y-m-d'), 'log_type' => 'rfid'])->get()->unique('user_id');
            $enrolledUsers = [];
            $unenrolledUsers = [];

            foreach ($users as $user) {
                if ($user->status->enrollment_status) {
                    array_push($enrolledUsers, $user);
                    if ($user->status->card_registered) {
                        array_push($usersWithCard, $user);
                    } else {
                        array_push($usersWithoutCard, $user);
                    }
                } else {
                    array_push($unenrolledUsers, $user);
                    if ($user->status->card_registered) {
                        array_push($usersWithCard, $user);
                    } else {
                        array_push($usersWithoutCard, $user);
                    }
                }
            }
           
            $sensitiveLogs = [];
            foreach ($today_rfid_logs as $log) {
                if ($log->device->room->room_security_level == 'SENSITIVE') {
                    array_push($sensitiveLogs, $log);
                };
            }

            $todayLogs = Log::where('date', date('Y-m-d'))->get(['user_id'])->unique('user_id');
            if (count($enrolledUsers) < 1) {
                $parcentageofPresentUsers = 0;
                $parcentageofabsentUsers = 0;
            } else {
                $parcentageofPresentUsers = round(($todayLogs->count() / count($enrolledUsers)) * 100, 2);
                $parcentageofabsentUsers = round(((count($enrolledUsers) - $todayLogs->count()) / count($enrolledUsers)) * 100, 2);
            }

            $organizations = Organization::all()->count();
            $branches = Branch::all()->count();
            $departments = Department::all()->count();
            $devices = Device::where('organization_id', $departmentId)->count();
            // $departments = Department::orderBy('created_at', 'desc')->take(5)->get();
            return view('dashboard')->with([
                'registeredUsers' => count($users),
                'enrolledUsers' => count($enrolledUsers),
                'unenrolledUsers' => count($unenrolledUsers),
                'presentUsers' => $parcentageofPresentUsers,
                'absentUsers' => $parcentageofabsentUsers,
                'registeredOrganizations' => $organizations,
                'registeredBranches' => $branches,
                'registeredDepartments' => $departments,
                'registeredDevices' => $devices
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
        //
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
}

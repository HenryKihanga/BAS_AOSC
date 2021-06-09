<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Device;
use App\Models\Log;
use App\Models\Organization;
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
        if (Gate::allows('isAdmin')) {
            $users = User::all();
            $enrolledUsers = [];
            $unenrolledUsers = [];
            foreach ($users as $user) {
                if ($user->status->enrollment_status) {
                    array_push($enrolledUsers , $user);
                } else {
                    array_push($unenrolledUsers, $user);
                }
            }
            $numberofUsers = $users->count();
            $todayLogs = Log::where('date', date('Y-m-d'))->get(['user_id'])->unique('user_id');
            $parcentageofPresentUsers = round(($todayLogs->count()/count($enrolledUsers)) * 100 , 2);
            $parcentageofabsentUsers = round(((count($enrolledUsers)- $todayLogs->count())/count($enrolledUsers)) * 100 , 2);
            $organizations = Organization::all()->count();
            $branches = Branch::all()->count();
            $departments = Department::all()->count();
            $devices = Device::all()->count();
            // $departments = Department::orderBy('created_at', 'desc')->take(5)->get();
            return view('dashboard')->with([
                'registeredUsers' => $numberofUsers,
                'enrolledUsers' => count($enrolledUsers),
                'unenrolledUsers' => count($unenrolledUsers),
                'presentUsers' => $parcentageofPresentUsers,
                'absentUsers' => $parcentageofabsentUsers,
                'registeredOrganizations' => $organizations,
                'registeredBranches' => $branches,
                'registeredDepartments' => $departments,
                'registeredDevices' => $devices

            ]);
            // return view('department.manage')->with([
            //     'branches' => $branches,
            //     'organizations' => $organizations,
            //     'departments' => $departments
            // ]);
        }
        if (Gate::allows('isOrganizationHead')) {
            foreach (User::find($userId)->organization->branches as $branch) {
                $departments =  $branch->departments;
            }
            return view('department.manage')->with([
                'departments' => $departments
            ]);
        }

        if (Gate::allows('isBranchHead')) {
            $departments = User::find($userId)->branch->departments;

            return view('department.manage')->with([
                'departments' => $departments
            ]);
        }
        if (Gate::allows('isDepartmentHead')) {
            $departments = [];
            $department = User::find($userId)->department;
            array_push($departments, $department);
            return view('department.manage')->with([
                'departments' => $departments,
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

<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Device;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeviceController extends Controller
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
        $departments = Department::all();
        $devices = Device::orderBy('created_at', 'desc')->take(5)->get();
        return view('device.manage')->with([
            'branches' => $branches,
            'organizations' => $organizations,
            'departments' => $departments,
            'devices' => $devices
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
            'departmentId' => 'required',
            'deviceToken' => 'required',
            'deviceName' => 'required',
            'deviceLocation' => 'required',
        ]);

        $department = Department::find($request->input('departmentId'));
        if (!$department) {
            return response()->json([
                'error' => 'Organization Not Exist,make sure you register organization'
            ]);
        }

        $device = new Device();
        $device->device_token = $request->input('deviceToken');
        $device->device_name = $request->input('deviceName');
        $device->device_location = $request->input('deviceLocation');
        if ($department->devices()->save($device)) {
            return redirect()->route('deviceManage');
            // $newDevice = Device::find($device->device_token);
            // return response()->json([
            //     'success' => 'success',
            //     'newDevice' => $newDevice
            // ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function show(Device $device)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $device = Device::find($id);
        return response()->json([
            'device' => $device
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'deviceToken' => 'required',
            'deviceName' => 'required',
            'deviceLocation' => 'required',
            // 'deviceOrganization' => 'required',
        ]);

        $device = Device::find($request->input('deviceToken'));
        if (!$device) {
            return response()->json([
                'error' => 'device Not Exist,make sure you register organization'
            ]);
        }

        $device->update([
            'device_name' => $request->input('deviceName'),
            'device_location' => $request->input('deviceLocation'),
            'organization_id' => $request->input('deviceOrganization'),
            'device_mode' => $device->device_mode,

        ]);
        return response()->json([
            'device' => $device
        ], 206);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function destroy(Device $device)
    {
        //
    }

    public function showOne($deviceId)
    {
        $device = Device::find($deviceId);
        if (!$device) {
            return response()->json([
                'error' => 'device do not exist'
            ], 404);
        }

        return response()->json([
            'device' => $device
        ], 200);
    }

    public function showAll()
    {
        $devices = Device::all();
        foreach ($devices as $device) {
            foreach ($device->users as $user) {
                $user->status;
            }
        }
        return response()->json([
            'devices' => $devices
        ], 200);
    }

    public function changeMode($deviceToken , $mode)
    {
    

        $device = Device::find($deviceToken);
        $device->update([
            'device_mode' => $mode
        ]);

        return redirect()->route('deviceManage');
        // return response()->json([
        //     'success' => 'success',
        //     'device' => $device
        // ]);
    }


    //check and return device mode
    public function checkMode($deviceToken)
    {
        if ($device = Device::find($deviceToken)) {
            $mode = $device->device_mode;
            return  strval($mode);
        }

        return "device not found";
    }
}

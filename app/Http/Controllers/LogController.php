<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Log;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

class LogController extends Controller
{
    public function index()
    {
        $logs = Log::all();
        // $todayLogs = Log::where('date', date('Y-m-d'))->get();
        return view('log.overall')->with([
            'logs' => $logs,
            'type' => 1
        ]);
    }

    //HII METHOD INARUDISHA LOGS OF PRESENT USERS
    public function userPresentToday()
    {

        $todayLogs = Log::where('date', date('Y-m-d'))->get();
        return view('log.overall')->with([
            'logs' => $todayLogs,
            'type' => 1
        ]);
    }
    //HII METHOD INARUDISHA USER DETAILS FOR ABSENTEES
    public function userAbsenteToday()
    {
        $todayLogs = Log::where('date', date('Y-m-d'))->get('user_id')->unique();
        $user_ids = [];
        foreach ($todayLogs as $id){
            array_push($user_ids , $id->user_id);
        }
        $absenteUsers = User::all()->whereNotIn('user_id', $user_ids);
        $enrolledUsers = [];
        foreach ($absenteUsers as $user) {
            if ($user->status->enrollment_status) {
                array_push($enrolledUsers, $user);
            } else {
                continue;
            }
        }
        // return response()->json([
        //     'logs' => $enrolledUsers,
        //     'type' => 0
        // ]);
        return view('log.overall')->with([
            'logs' => $enrolledUsers,
            'type' => 0
        ]);
    }

    public function userSpecificLogs($userId)
    {
        $useLog = Log::all()->where('user_id', $userId);
        return view('log.overall')->with([
            'logs' => $useLog,
            'type' => 1
        ]);
    }
    public function fingerprintCheckInOrOut($fingerPrintId, $deviceToken)
    {
        $currentTime = Carbon::now()->timezone('Africa/Dar_es_Salaam')->format('Y-m-d H:i:s'); //get current time
        $currentDate = date('Y-m-d'); //get current date
        $device = Device::where('device_token', $deviceToken)->where('device_type', 'fingerprint')->first(); //fetch device that sends request
        //check if the device found
        if ($device) {
            //If device found check if its mode is attendance
            if ($device->device_mode == 1) {
                $users = $device->fingerprintUsers; //pull all users registered to that device
                //check if there is/are user(s)
                if (count($users) == 0) {
                    return "No user has been registered in this device";
                } else {
                    foreach ($users as $user) {
                        //if user found check user that has been selected to be already enrolled with finger id sent from the device
                        if ($user->status->fingerprint_id == $fingerPrintId && $user->status->enrollment_status == 1) {
                            $userName = $user->first_name . " " . $user->middle_name . " " . $user->last_name; // get user name
                            $todayLogs = Log::where('user_id', $user->user_id)->where('date', $currentDate)->where('log_type', $device->device_type)->get(); //get all logs of that user on a particular day
                            //if no log found create new
                            if (count($todayLogs) == 0) {
                                Log::create([
                                    'user_id' => $user->user_id,
                                    'time_in' => $currentTime,
                                    'log_type' => $device->device_type,
                                    'date' => $currentDate
                                ]);
                                return "login" . $userName;
                            } else {
                                //if logs found loop through and update the time out field
                                foreach ($todayLogs as $log) {
                                    if ($log->time_out == null) {
                                        $log->update([
                                            'time_out' => $currentTime
                                        ]);
                                        return "logout" . $userName;
                                    } else {
                                        continue;
                                    }
                                }
                                //if for the found log all check out time is note null create new log
                                Log::create([
                                    'user_id' => $user->user_id,
                                    'time_in' => $currentTime,
                                    'log_type' => $device->device_type,
                                    'date' => $currentDate
                                ]);
                                return "login" . $userName;
                            }
                        } else {
                            continue;
                        }
                    }
                    return "This user is not enrolled";
                }
            } else {
                return "Device is currently in enrollment mode";
            }
        } else {
            return "Device not found";
        }
    }

    public function rfidCheckInOrOut($cardUid, $deviceToken)
    {
        $currentTime = Carbon::now()->timezone('Africa/Dar_es_Salaam')->format('Y-m-d H:i:s'); //get current time
        $currentDate = date('Y-m-d'); //get current date
        $device = Device::where('device_token', $deviceToken)->where('device_type', 'rfid')->first(); //fetch device that sends request
        //check if the device found
        if ($device) {
            //If device found check if its mode is attendance
            if ($device->device_mode == 1) {
                $users = $device->rfidUsers; //pull all users registered to that device

                //check if there is/are user(s)
                if (count($users) == 0) {
                    return "No user has been registered in this device";
                } else {
                    foreach ($users as $user) {
                        //if user found check user that has been selected to be already enrolled with finger id sent from the device
                        if ($user->status->card_uid == $cardUid && $user->status->card_registered == 1) {
                            $userName = $user->first_name . " " . $user->middle_name . " " . $user->last_name; // get user name
                            $todayLogs = Log::where('user_id', $user->user_id)->where('log_type', $device->device_type)->where('date', $currentDate)->get(); //get all logs of that user on a particular day
                            //if no log found create new
                            if (count($todayLogs) == 0) {
                                Log::create([
                                    'user_id' => $user->user_id,
                                    'time_in' => $currentTime,
                                    'log_type' => $device->device_type,
                                    'date' => $currentDate
                                ]);
                                return "checkin" . $userName;
                            } else {
                                //if logs found loop through and update the time out field
                                foreach ($todayLogs as $log) {
                                    if ($log->time_out == null) {
                                        $log->update([
                                            'time_out' => $currentTime
                                        ]);
                                        return "checkout" . $userName;
                                    } else {
                                        continue;
                                    }
                                }
                                //if for the found log all check out time is note null create new log
                                Log::create([
                                    'user_id' => $user->user_id,
                                    'time_in' => $currentTime,
                                    'log_type' => $device->device_type,
                                    'date' => $currentDate
                                ]);
                                return "checkin" . $userName;
                            }
                        } else {
                            continue;
                        }
                    }
                    return "User Card not registered";
                }
            } else {
                return "Device is currently in enrollment mode";
            }
        } else {
            return "Device not found";
        }
    }
}

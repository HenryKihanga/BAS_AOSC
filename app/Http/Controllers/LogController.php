<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Log;
use Carbon\Carbon;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class LogController extends Controller
{
    public function checkInOrOut($fingerPrintId, $deviceToken)
    {
        $currentTime = Carbon::now()->timezone('Africa/Dar_es_Salaam')->format('H:i:s'); //get current time
        $currentDate = date('d-m-Y'); //get current date
        $device = Device::find($deviceToken); //fetch device that sends request
        //check if the device found
        if ($device) {
            //If device found check if its mode is attendance
            if ($device->device_mode == 1) {
                $users = $device->users; //pull all users registered to that device
                //check if there is/are user(s)
                if (count($users) == 0) {
                    return "No user has been registered in this device";
                } else {
                    foreach ($users as $user) {
                        //if user found check user that has been selected to be enrolled with finger id sent from the device
                        if ($user->status->fingerprint_id == $fingerPrintId && $user->status->enrollment_status == 1) {
                            $userName = $user->first_name; // get user name
                            $todayLogs = Log::where('user_id', $user->user_id)->where('date', $currentDate)->get(); //get all logs of that user on a particular day
                            //if no log found create new
                            if (count($todayLogs) == 0) {
                                Log::create([
                                    'user_id' => $user->user_id,
                                    'time_in' => $currentTime,
                                    'date' => $currentDate
                                ]);
                                return "login";
                            } else {
                                //if logs found loop through and update the time out field
                                foreach ($todayLogs as $log) {
                                    if ($log->time_out == null) {
                                        $log->update([
                                            'time_out' => $currentTime
                                        ]);
                                        return "logout";
                                    } else {
                                        continue;
                                    }
                                }

                                //if for the found log all check out time is note null create new log
                                Log::create([
                                    'user_id' => $user->user_id,
                                    'time_in' => $currentTime,
                                    'date' => $currentDate
                                ]);
                                return "login";
                            }
                        } else {
                            continue;
                        }
                    }
                }
            } else {
                return "Device is currently in enrollment mode";
            }
        } else {
            return "Device not found";
        }
    }
}

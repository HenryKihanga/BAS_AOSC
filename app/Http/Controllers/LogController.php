<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Log;
use App\Models\User;
use App\Models\Userstatus;
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

    public function fingerprintOverallLogs($userId)
    {
        if (Gate::allows('isAdmin')) {
            $logs = Log::orderBy('created_at', 'ASC')->where('log_type', 'fingerprint')->get();
            // $todayLogs = Log::where('date', date('Y-m-d'))->get();
            return view('log.fingerprintoveralllogs')->with([
                'logs' => $logs,
                'arrive_time' => '07:30:00'

            ]);
        } elseif (Gate::allows('isOrganizationHead')) {
            $organizationId = User::find($userId)->organization_id; //Get organization id of logged in user
            $users = User::where('organization_id', $organizationId)->get(); //get all users of the particular organization
            $logs = Log::orderBy('created_at', 'ASC')->where('log_type', 'fingerprint')->whereIn('user_id', $users)->get();
            // $todayLogs = Log::where('date', date('Y-m-d'))->get();
            return view('log.fingerprintoveralllogs')->with([
                'logs' => $logs,
                'arrive_time' => '07:30:00'

            ]);
        } elseif (Gate::allows('isBranchHead')) {
            $branchId = User::find($userId)->branch_id; //Get branch id of logged in user
            $users = User::where('branch_id', $branchId)->get('user_id'); //get all users of the particular branch
            $logs = Log::orderBy('created_at', 'ASC')->where('log_type', 'fingerprint')->whereIn('user_id', $users)->get();
            // $todayLogs = Log::where('date', date('Y-m-d'))->get();
            return view('log.fingerprintoveralllogs')->with([
                'logs' => $logs,
                'arrive_time' => '07:30:00'

            ]);
        } elseif (Gate::allows('isDepartmentHead')) {
            $departmentId = User::find($userId)->department_id; //Get department id of logged in user
            $users = User::where('department_id', $departmentId)->get('user_id'); //get all users of the particular department
            $logs = Log::orderBy('created_at', 'ASC')->where('log_type', 'fingerprint')->whereIn('user_id', $users)->get();
            // $todayLogs = Log::where('date', date('Y-m-d'))->get();
            return view('log.fingerprintoveralllogs')->with([
                'logs' => $logs,
                'arrive_time' => '07:30:00'

            ]);
        }
    }

    public function rfidOverallLogs($userId)
    {
        if (Gate::allows('isAdmin')) {
            $logs = Log::orderBy('created_at', 'ASC')->where('log_type', 'rfid')->get();
            // $todayLogs = Log::where('date', date('Y-m-d'))->get();
            return view('log.rfidoveralllogs')->with([
                'logs' => $logs,
            ]);
        }
        elseif (Gate::allows('isOrganizationHead')) {
            $organizationId = User::find($userId)->organization_id; //Get organization id of logged in user
            $users = User::where('organization_id', $organizationId)->get(); //get all users of the particular organization
            $logs = Log::orderBy('created_at', 'ASC')->where('log_type', 'rfid')->whereIn('user_id', $users)->get();
            // $todayLogs = Log::where('date', date('Y-m-d'))->get();
            return view('log.rfidoveralllogs')->with([
                'logs' => $logs,
            ]);
        }
        elseif (Gate::allows('isBranchHead')) {
            $branchId = User::find($userId)->branch_id; //Get branch id of logged in user
            $users = User::where('branch_id', $branchId)->get('user_id'); //get all users of the particular branch
            $logs = Log::orderBy('created_at', 'ASC')->where('log_type', 'rfid')->whereIn('user_id', $users)->get();
            // $todayLogs = Log::where('date', date('Y-m-d'))->get();
            return view('log.rfidoveralllogs')->with([
                'logs' => $logs,
            ]);
        }
        elseif (Gate::allows('isDepartmentHead')) {
            $departmentId = User::find($userId)->department_id; //Get department id of logged in user
            $users = User::where('department_id', $departmentId)->get('user_id'); //get all users of the particular department
            $logs = Log::orderBy('created_at', 'ASC')->where('log_type', 'rfid')->whereIn('user_id', $users)->get();
            // $todayLogs = Log::where('date', date('Y-m-d'))->get();
            return view('log.rfidoveralllogs')->with([
                'logs' => $logs,
            ]);
        }
    }


    //HII METHOD INARUDISHA LOGS OF PRESENT USERS
    public function usersPresentToday($userId)
    {

        if (Gate::allows('isAdmin')) {
            $todayLogs = Log::orderBy('created_at', 'ASC')->where('date', date('Y-m-d'))->where('log_type', 'fingerprint')->get();
            return view('log.userspresenttoday')->with([
                'logs' => $todayLogs,
                'arrive_time' => '07:30:00'

            ]);
        } elseif (Gate::allows('isOrganizationHead')) {
            $organizationId = User::find($userId)->organization_id; //Get department id of logged in user
            $users = User::where('organization_id', $organizationId)->get('user_id'); //get all users of the particular department
            $todayLogs = Log::orderBy('created_at', 'ASC')->where('date', date('Y-m-d'))->where('log_type', 'fingerprint')->whereIn('user_id', $users)->get();
            return view('log.userspresenttoday')->with([
                'logs' => $todayLogs,
                'arrive_time' => '07:30:00'

            ]);
        } elseif (Gate::allows('isBranchHead')) {
            $branchId = User::find($userId)->branch_id; //Get branch id of logged in user
            $users = User::where('branch_id', $branchId)->get('user_id'); //get all users of the particular branch
            $todayLogs = Log::orderBy('created_at', 'ASC')->where('date', date('Y-m-d'))->where('log_type', 'fingerprint')->whereIn('user_id', $users)->get();
            return view('log.userspresenttoday')->with([
                'logs' => $todayLogs,
                'arrive_time' => '07:30:00'

            ]);
        } elseif (Gate::allows('isDepartmentHead')) {
            $departmentId = User::find($userId)->department_id; //Get department id of logged in user
            $users = User::where('department_id', $departmentId)->get('user_id'); //get all users of the particular department
            $todayLogs = Log::orderBy('created_at', 'ASC')->where('date', date('Y-m-d'))->where('log_type', 'fingerprint')->whereIn('user_id', $users)->get();
            return view('log.userspresenttoday')->with([
                'logs' => $todayLogs,
                'arrive_time' => '07:30:00'

            ]);
        }
    }
    //HII METHOD INARUDISHA USER DETAILS FOR ABSENTEES
    public function usersAbsenteToday($userId)
    {
        if (Gate::allows('isAdmin')) {
            $todayLogs = Log::where('date', date('Y-m-d'))->get('user_id')->unique();
            $user_ids = [];
            foreach ($todayLogs as $id) {
                array_push($user_ids, $id->user_id);
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
            return view('log.usersabsentetoday')->with([
                'logs' => $enrolledUsers,

            ]);
        } elseif (Gate::allows('isOrganizationHead')) {
            $organizationId = User::find($userId)->organization_id; //Get department id of logged in user
            $todayLogs = Log::where('date', date('Y-m-d'))->get('user_id')->unique();
            $user_ids = [];
            foreach ($todayLogs as $id) {
                array_push($user_ids, $id->user_id);
            }
            $absenteUsers = User::where('organization_id', $organizationId)->whereNotIn('user_id', $user_ids)->get();
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
            return view('log.usersabsentetoday')->with([
                'logs' => $enrolledUsers,

            ]);
        } elseif (Gate::allows('isBranchHead')) {
            $branchId = User::find($userId)->branch_id;
            $todayLogs = Log::where('date', date('Y-m-d'))->get('user_id')->unique();
            $user_ids = [];
            foreach ($todayLogs as $id) {
                array_push($user_ids, $id->user_id);
            }
            $absenteUsers = User::where('branch_id', $branchId)->whereNotIn('user_id', $user_ids)->get();
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
            return view('log.usersabsentetoday')->with([
                'logs' => $enrolledUsers,

            ]);
        } elseif (Gate::allows('isDepartmentHead')) {
            $departmentId = User::find($userId)->department_id; //Get department id of logged in user
            $todayLogs = Log::where('date', date('Y-m-d'))->get('user_id')->unique();
            $user_ids = [];
            foreach ($todayLogs as $id) {
                array_push($user_ids, $id->user_id);
            }
            $absenteUsers = User::where('department_id', $departmentId)->whereNotIn('user_id', $user_ids)->get();
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
            return view('log.usersabsentetoday')->with([
                'logs' => $enrolledUsers,

            ]);
        }
    }

    public function userSpecificLogs($userId)
    {
        $useLog = Log::all()->where('user_id', $userId);
        return view('log.userlogs')->with([
            'logs' => $useLog,
            'user' => User::find($userId),
            'arrive_time' => '07:30:00'

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
                            // $userName = $user->first_name . " " . $user->middle_name . " " . $user->last_name; // get user name
                            $userName = $user->first_name; // get user name
                            $todayLogs = Log::where('user_id', $user->user_id)->where('date', $currentDate)->where('log_type', $device->device_type)->get(); //get all logs of that user on a particular day
                            //if no log found create new
                            if (count($todayLogs) == 0) {
                                Log::create([
                                    'user_id' => $user->user_id,
                                    'time_in' => $currentTime,
                                    'log_type' => $device->device_type,
                                    'date' => $currentDate,
                                    'device_token' => $device->device_token
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
                                    'date' => $currentDate,
                                    'device_token' => $device->device_token
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
            $userstatus = Userstatus::where('card_uid', $cardUid)->first(); //find userstatus with given card ID
            //check if user status found
            if (!$userstatus) {
                //IF CARD ID NOT FOUND SAVE THE CARD ID
                $newUserStatus = Userstatus::where('ready_to_add_card', 1)->first();
                if ($newUserStatus) {
                    $userName = $newUserStatus->user->first_name . " " . $newUserStatus->user->middle_name . " " . $newUserStatus->user->last_name; // get user name
                    $newUserStatus->user->update([
                        'rfid_device_token' => $deviceToken
                    ]);
                    //FORGING CHANGE OF DEVICE MODE
                    $device->update([
                        'device_mode' => 1
                    ]);
                    $newUserStatus->update([
                        'card_uid' => $cardUid,
                        'card_registered' => 1,
                        'ready_to_add_card' => 0
                    ]);

                    return "success Card Registered for " . $userName;
                } else {
                    return "Card not found | no new user to enroll";
                }
            } else {
                //if userstatus found check if card if full regustered
                if ($userstatus->card_registered == 1) {
                    $userName = $userstatus->user->first_name . " " . $userstatus->user->middle_name . " " . $userstatus->user->last_name; // get user name
                    $todayLogs = Log::where('user_id', $userstatus->user->user_id)->where('log_type', $device->device_type)->where('date', $currentDate)->where('device_token', $device->device_token)->get(); //get all logs of that user on a particular day
                    // $deviceLogs = $deviceLogs
                    //if no log found create new
                    if (count($todayLogs) == 0) {
                        Log::create([
                            'user_id' => $userstatus->user->user_id,
                            'time_in' => $currentTime,
                            'log_type' => $device->device_type,
                            'date' => $currentDate,
                            'device_token' => $device->device_token
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
                            'user_id' => $userstatus->user->user_id,
                            'time_in' => $currentTime,
                            'log_type' => $device->device_type,
                            'date' => $currentDate,
                            'device_token' => $device->device_token
                        ]);
                        return "checkin" . $userName;
                    }
                } else {
                    return "Card is Partially Registered";
                }
            }
        } else {
            return "Device not found";
        }
    }

    // public function rfidCheckInOrOut($cardUid, $deviceToken)
    // {
    //     $currentTime = Carbon::now()->timezone('Africa/Dar_es_Salaam')->format('Y-m-d H:i:s'); //get current time
    //     $currentDate = date('Y-m-d'); //get current date
    //     $device = Device::where('device_token', $deviceToken)->where('device_type', 'rfid')->first(); //fetch device that sends request
    //     //check if the device found
    //     if ($device) {
    //         //If device found check if its mode is attendance
    //         if ($device->device_mode == 1) {
    //             $users = $device->rfidUsers; //pull all users registered to that device

    //             //check if there is/are user(s)
    //             if (count($users) == 0) {
    //                 return "No user has been registered in this device";
    //             } else {
    //                 foreach ($users as $user) {
    //                     //if user found check user that has been selected to be already enrolled with finger id sent from the device
    //                     if ($user->status->card_uid == $cardUid && $user->status->card_registered == 1) {
    //                         $userName = $user->first_name . " " . $user->middle_name . " " . $user->last_name; // get user name
    //                         $todayLogs = Log::where('user_id', $user->user_id)->where('log_type', $device->device_type)->where('date', $currentDate)->get(); //get all logs of that user on a particular day
    //                         //if no log found create new
    //                         if (count($todayLogs) == 0) {
    //                             Log::create([
    //                                 'user_id' => $user->user_id,
    //                                 'time_in' => $currentTime,
    //                                 'log_type' => $device->device_type,
    //                                 'date' => $currentDate,
    //                                 'device_token' => $device->device_token
    //                             ]);
    //                             return "checkin" . $userName;
    //                         } else {
    //                             //if logs found loop through and update the time out field
    //                             foreach ($todayLogs as $log) {
    //                                 if ($log->time_out == null) {
    //                                     $log->update([
    //                                         'time_out' => $currentTime
    //                                     ]);
    //                                     return "checkout" . $userName;
    //                                 } else {
    //                                     continue;
    //                                 }
    //                             }
    //                             //if for the found log all check out time is note null create new log
    //                             Log::create([
    //                                 'user_id' => $user->user_id,
    //                                 'time_in' => $currentTime,
    //                                 'log_type' => $device->device_type,
    //                                 'date' => $currentDate,
    //                                 'device_token' => $device->device_token
    //                             ]);
    //                             return "checkin" . $userName;
    //                         }
    //                     } else {
    //                         continue;
    //                     }
    //                 }
    //                 return "User Card not registered";
    //             }
    //         } else {
    //             return "Device is currently in enrollment mode";
    //         }
    //     } else {
    //         return "Device not found";
    //     }
    // }

    // public function fidCheckInOrOut($cardUid, $deviceToken)
    // {
    //     $userstatus = Userstatus::where('card_uid', $cardUid)->first();
    //     $device = Device::where('device_token', $deviceToken)->where('device_type', 'rfid')->first();
    //     $currentDate = date('Y-m-d');
    //     $todayLogs = Log::where('user_id', $userstatus->user->user_id)->where('log_type', $device->device_type)->where('date', $currentDate)->where('device_token', $deviceToken)->get();

    //     return response()->json([
    //         'logs' => $todayLogs
    //     ]);
    // }
    public function allLogs()
    {

        $logs = Log::orderBy('id', 'desc')->get();
        foreach ($logs as $log) {
            $log->device->room;
        }

        return response()->json([
            'logs' => $logs
        ]);
    }

    public function sensitiveLogs($userId)
    {
        if (Gate::allows('isAdmin')) {
            $today_logs = Log::where(['date' => date('Y-m-d'), 'log_type' => 'rfid'])->get();
            $sensitiveLogs = [];
            foreach ($today_logs as $log) {
                if ($log->device->room->room_security_level == 'SENSITIVE') {
                    array_push($sensitiveLogs, $log);
                };
            }

            return view('log.sensitivelogs')->with([
                'logs' => $sensitiveLogs
            ]);
            // return response()->json([
            //     'logs' => $sensitiveLogs,
            // ]);
        } elseif (Gate::allows('isOrganizationHead')) {
            $organizationId = User::find($userId)->organization_id; //Get department id of logged in user
            $users = User::where('organization_id', $organizationId)->get('user_id'); //get all users of the particular department
            $today_logs = Log::where(['date' => date('Y-m-d'), 'log_type' => 'rfid'])->whereIn('user_id', $users)->get();
            $sensitiveLogs = [];
            foreach ($today_logs as $log) {
                if ($log->device->room->room_security_level == 'SENSITIVE') {
                    array_push($sensitiveLogs, $log);
                };
            }

            return view('log.sensitivelogs')->with([
                'logs' => $sensitiveLogs
            ]);
            // return response()->json([
            //     'logs' => $sensitiveLogs,
            // ]);
        } elseif (Gate::allows('isBranchHead')) {
            $branchId = User::find($userId)->branch_id; //Get branch id of logged in user
            $users = User::where('branch_id', $branchId)->get('user_id'); //get all users of the particular branch
            $today_logs = Log::where(['date' => date('Y-m-d'), 'log_type' => 'rfid'])->whereIn('user_id', $users)->get();
            $sensitiveLogs = [];
            foreach ($today_logs as $log) {
                if ($log->device->room->room_security_level == 'SENSITIVE') {
                    array_push($sensitiveLogs, $log);
                };
            }

            return view('log.sensitivelogs')->with([
                'logs' => $sensitiveLogs
            ]);
            // return response()->json([
            //     'logs' => $sensitiveLogs,
            // ]);
        } elseif (Gate::allows('isDepartmentHead')) {
            $departmentId = User::find($userId)->department_id; //Get department id of logged in user
            $users = User::where('department_id', $departmentId)->get('user_id'); //get all users of the particular department
            $today_logs = Log::where(['date' => date('Y-m-d'), 'log_type' => 'rfid'])->whereIn('user_id', $users)->get();
            $sensitiveLogs = [];
            foreach ($today_logs as $log) {
                if ($log->device->room->room_security_level == 'SENSITIVE') {
                    array_push($sensitiveLogs, $log);
                };
            }

            return view('log.sensitivelogs')->with([
                'logs' => $sensitiveLogs
            ]);
            // return response()->json([
            //     'logs' => $sensitiveLogs,
            // ]);
        }
    }

    public function nonSensitiveLogs($userId)
    {
        if (Gate::allows('isAdmin')) {
            $logs = Log::all();
            $nonSensitiveLogs = [];
            foreach ($logs as $log) {
                if ($log->device->room->room_security_level == 'NORMAL') {
                    array_push($nonSensitiveLogs, $log);
                };
            }

            return response()->json([
                'logs' => $nonSensitiveLogs,
            ]);
        } elseif (Gate::allows('isOrganizationHead')) {
            $organizationId = User::find($userId)->organization_id; //Get department id of logged in user
            $users = User::where('organization_id', $organizationId)->get('user_id'); //get all users of the particular department
            $logs = Log::whereIn('user_id', $users)->get();;
            $nonSensitiveLogs = [];
            foreach ($logs as $log) {
                if ($log->device->room->room_security_level == 'NORMAL') {
                    array_push($nonSensitiveLogs, $log);
                };
            }

            return response()->json([
                'logs' => $nonSensitiveLogs,
            ]);
        } elseif (Gate::allows('isBranchHead')) {
            $branchId = User::find($userId)->branch_id; //Get branch id of logged in user
            $users = User::where('branch_id', $branchId)->get('user_id'); //get all users of the particular branch
            $logs = Log::whereIn('user_id', $users)->get();;
            $nonSensitiveLogs = [];
            foreach ($logs as $log) {
                if ($log->device->room->room_security_level == 'NORMAL') {
                    array_push($nonSensitiveLogs, $log);
                };
            }

            return response()->json([
                'logs' => $nonSensitiveLogs,
            ]);
        } elseif (Gate::allows('isDepartmentHead')) {
            $departmentId = User::find($userId)->department_id; //Get department id of logged in user
            $users = User::where('department_id', $departmentId)->get('user_id'); //get all users of the particular department
            $logs = Log::whereIn('user_id', $users)->get();;
            $nonSensitiveLogs = [];
            foreach ($logs as $log) {
                if ($log->device->room->room_security_level == 'NORMAL') {
                    array_push($nonSensitiveLogs, $log);
                };
            }

            return response()->json([
                'logs' => $nonSensitiveLogs,
            ]);
        }
    }
}

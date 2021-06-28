<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Room;
use App\Models\Userstatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::truncate();
        DB::table('role_user')->truncate();
        $adminRole = Role::where('name', 'admin')->first();
        $organizationHeadRole = Role::where('name', 'organizationHead')->first();
        $branchHeadRole = Role::where('name', 'branchHead')->first();
        $departmentHeadRole = Role::where('name', 'departmentHead')->first();
        $staffRole = Role::where('name', 'staff')->first();

        $department = Department::find(1);
        $adminrooms = Room::find([1,2,3]);
        $organizationHeadRooms = Room::find([2,3,4,5]);
        $branchHeadRooms = Room::find([3,4,5,6,7]);

        $admin = new User();
        $admin->user_id = 1;
        // $admin->device_token = 1;
        $admin->first_name = 'Sarah';
        $admin->middle_name = 'Emmanuel';
        $admin->organization_id = 1;
        $admin->branch_id = 1;
        $admin->last_name = 'Mnadi';
        $admin->phone_number = '0676873456';
        $admin->birth_date = '12/12/2020';
        $admin->email = 'mnadisarah@gmail.com';
        $admin->password = Hash::make(strtoupper('mnadi'));
        $admin->status()->create([
            'fingerprint_id'=>null,
            'ready_to_enroll'=> 0,
            'enrollment_status' => 0,
            'delete_status' => 0
        ]);
        $admin->roles()->attach($adminRole);
        $admin->rooms()->attach($adminrooms);
        $department->users()->save($admin);


        $organizationHead = new User();
        $organizationHead->user_id = 2;
        // $organizationHead->device_token = 1;
        $organizationHead->first_name = 'William';
        $organizationHead->middle_name = 'Jumanne';
        $organizationHead->organization_id = 1;
        $organizationHead->branch_id = 1;
        $organizationHead->last_name = 'Kiluma';
        $organizationHead->phone_number = '0676873456';
        $organizationHead->birth_date = '12/12/2020';
        $organizationHead->email = 'kilumawilliam@gmail.com';
        $organizationHead->password = Hash::make(strtoupper('Kiluma'));
        $organizationHead->status()->create([
            'fingerprint_id'=>null,
            'ready_to_enroll'=> 0,
            'enrollment_status' => 0,
            'delete_status' => 0
        ]);
        $organizationHead->roles()->attach($organizationHeadRole);
        $organizationHead->rooms()->attach($organizationHeadRooms);
        $department->users()->save($organizationHead);
      

        $branchHead = new User();
        $branchHead->user_id = 3;
        // $branchHead->device_token = 1;
        $branchHead->first_name = 'Kelvin';
        $branchHead->middle_name = 'Mussa';
        $branchHead->organization_id = 1;
        $branchHead->branch_id = 1;
        $branchHead->last_name = 'Hongo';
        $branchHead->phone_number = '0676873456';
        $branchHead->birth_date = '12/12/2020';
        $branchHead->email = 'hongokelvin@gmail.com';
        $branchHead->password = Hash::make(strtoupper('Hongo'));
        $branchHead->status()->create([
            'fingerprint_id'=>null,
            'ready_to_enroll'=> 0,
            'enrollment_status' => 0,
            'delete_status' => 0
        ]);
        $branchHead->roles()->attach($branchHeadRole);
        $branchHead->rooms()->attach($branchHeadRooms);
        $department->users()->save($branchHead);
 


        $departmentHead = new User();
        $departmentHead->user_id = 4;
        // $departmentHead->device_token = 1;
        $departmentHead->first_name = 'Mpoki';
        $departmentHead->middle_name = 'Abel';
        $departmentHead->organization_id = 1;
        $departmentHead->branch_id = 1;
        $departmentHead->last_name = 'Mwaisela';
        $departmentHead->phone_number = '0676873456';
        $departmentHead->birth_date = '12/12/2020';
        $departmentHead->email = 'mwaiselampoki@gmail.com';
        $departmentHead->password = Hash::make(strtoupper('Mwaisela'));
        $departmentHead->status()->create([
            'fingerprint_id'=>null,
            'ready_to_enroll'=> 0,
            'enrollment_status' => 0,
            'delete_status' => 0
        ]);
        $departmentHead->roles()->attach($departmentHeadRole);
        $department->users()->save($departmentHead);


        $staff = new User();
        $staff->user_id = 5;
        $staff->first_name = 'Shabani';
        $staff->organization_id = 1;
        $staff->branch_id = 1;
        $staff->middle_name = '';
        // $staff->device_token = 1;
        $staff->last_name = 'Rashidi';
        $staff->phone_number = '0676873456';
        $staff->birth_date = '12/12/2020';
        $staff->email = 'rashidishabani@gmail.com';
        $staff->password = null;
        $staff->status()->create([
            'fingerprint_id'=> null,
            'ready_to_enroll'=> 0,
            'enrollment_status' => 0,
            'delete_status' => 0
        ]);
        $staff->roles()->attach($staffRole);
        $department->users()->save($staff);
    }
}

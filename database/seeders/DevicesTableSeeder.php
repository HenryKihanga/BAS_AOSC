<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Device;
use Illuminate\Database\Seeder;

class DevicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Device::truncate();
        $csedepartment = Department::find(4);
        $deviceA = new Device();
        $deviceA->device_token = 1;
        $deviceA->device_name = "DEVICE A";
        $deviceA->device_type = 'fingerprint';
        $deviceA->room_id = 1;
        $deviceA->organization_id = 1;
        $deviceA->branch_id = 2;
        $csedepartment->devices()->save($deviceA);

        $deviceB = new Device();
        $deviceB->device_token = 2;
        $deviceB->device_name = "DEVICE B";
        $deviceB->device_type = 'fingerprint';
        $deviceB->room_id = 1;
        $deviceB->organization_id = 1;
        $deviceB->branch_id = 2;
        $csedepartment->devices()->save($deviceB);

        $deviceC = new Device();
        $deviceC->device_token = 3;
        $deviceC->device_name = "DEVICE C";
        $deviceC->device_type = 'fingerprint';
        $deviceC->room_id = 4;
        $deviceC->organization_id = 1;
        $deviceC->branch_id = 2;
        $csedepartment->devices()->save($deviceC);

        $deviceD = new Device();
        $deviceD->device_token = 4;
        $deviceD->device_name = "DEVICE D";
        $deviceD->device_type = 'fingerprint';
        $deviceD->room_id = 5;
        $deviceD->organization_id = 1;
        $deviceD->branch_id = 2;
        $csedepartment->devices()->save($deviceD);

        $deviceE = new Device();
        $deviceE->device_token = 5;
        $deviceE->device_name = "DEVICE E";
        $deviceE->device_type = 'rfid';
        $deviceE->room_id = 3;
        $deviceE->organization_id = 1;
        $deviceE->branch_id = 2;
        $csedepartment->devices()->save($deviceE);

        // $deviceB = new Device();
        // $deviceB->device_token = 2;
        // $deviceB->device_name = "DEVICE B";
        // $deviceB->device_mode = 1;
        // $deviceB->device_location = "Computer Room";
        // $deviceB->organization_id = 1;
        // $deviceB->branch_id = 1;
        // // $department->devices()->save($deviceB);

        // $deviceB = new Device();
        // $deviceB->device_token = 2;
        // $deviceB->device_name = "DEVICE B";
        // $deviceB->device_mode = 1;
        // $deviceB->device_location = "Computer Room";
        // $deviceB->organization_id = 1;
        // $deviceB->branch_id = 1;
        // // $department->devices()->save($deviceB);

        // $deviceB = new Device();
        // $deviceB->device_token = 2;
        // $deviceB->device_name = "DEVICE B";
        // $deviceB->device_mode = 1;
        // $deviceB->device_location = "Computer Room";
        // $deviceB->organization_id = 1;
        // $deviceB->branch_id = 1;
        // // $department->devices()->save($deviceB);

        // $deviceB = new Device();
        // $deviceB->device_token = 2;
        // $deviceB->device_name = "DEVICE B";
        // $deviceB->device_mode = 1;
        // $deviceB->device_location = "Computer Room";
        // $deviceB->organization_id = 1;
        // $deviceB->branch_id = 1;
        // // $department->devices()->save($deviceB);

        // $deviceB = new Device();
        // $deviceB->device_token = 2;
        // $deviceB->device_name = "DEVICE B";
        // $deviceB->device_mode = 1;
        // $deviceB->device_location = "Computer Room";
        // $deviceB->organization_id = 1;
        // $deviceB->branch_id = 1;
        // // $department->devices()->save($deviceB);

        // $deviceB = new Device();
        // $deviceB->device_token = 2;
        // $deviceB->device_name = "DEVICE B";
        // $deviceB->device_mode = 1;
        // $deviceB->device_location = "Computer Room";
        // $deviceB->organization_id = 1;
        // $deviceB->branch_id = 1;
        // // $department->devices()->save($deviceB);

        // $deviceB = new Device();
        // $deviceB->device_token = 2;
        // $deviceB->device_name = "DEVICE B";
        // $deviceB->device_mode = 1;
        // $deviceB->device_location = "Computer Room";
        // $deviceB->organization_id = 1;
        // $deviceB->branch_id = 1;
        // // $department->devices()->save($deviceB);

        // $deviceB = new Device();
        // $deviceB->device_token = 2;
        // $deviceB->device_name = "DEVICE B";
        // $deviceB->device_mode = 1;
        // $deviceB->device_location = "Computer Room";
        // $deviceB->organization_id = 1;
        // $deviceB->branch_id = 1;
        // // $department->devices()->save($deviceB);

        // $deviceB = new Device();
        // $deviceB->device_token = 2;
        // $deviceB->device_name = "DEVICE B";
        // $deviceB->device_mode = 1;
        // $deviceB->device_location = "Computer Room";
        // $deviceB->organization_id = 1;
        // $deviceB->branch_id = 1;
        // // $department->devices()->save($deviceB);

        // $deviceB = new Device();
        // $deviceB->device_token = 2;
        // $deviceB->device_name = "DEVICE B";
        // $deviceB->device_mode = 1;
        // $deviceB->device_location = "Computer Room";
        // $deviceB->organization_id = 1;
        // $deviceB->branch_id = 1;
        // $department->devices()->save($deviceB);
    }
}

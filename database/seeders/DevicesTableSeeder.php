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
        $department = Department::find(1);
        $deviceA = new Device();
        $deviceA->device_token = 1;
        $deviceA->device_name = "DEVICE A";
        $deviceA->device_location = "Server Room";
        $department->devices()->save($deviceA);

        $deviceB = new Device();
        $deviceB->device_token = 2;
        $deviceB->device_name = "DEVICE B";
        $deviceB->device_mode = 1;
        $deviceB->device_location = "Computer Room";
        $department->devices()->save($deviceB);
    }
}

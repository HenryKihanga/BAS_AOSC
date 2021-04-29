<?php

namespace Database\Seeders;

use App\Models\Device;
use App\Models\Organization;
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
        $organization = Organization::find(1);
        $deviceA = new Device();
        $deviceA->device_token = 1;
        $deviceA->device_name = "DEVICE A";
        $deviceA->device_location = "Server Room";
        $organization->devices()->save($deviceA);

        $deviceB = new Device();
        $deviceB->device_token = 2;
        $deviceB->device_name = "DEVICE B";
        $deviceB->device_location = "Computer Room";
        $organization->devices()->save($deviceB);
    }
}

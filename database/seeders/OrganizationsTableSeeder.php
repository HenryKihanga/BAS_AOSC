<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Seeder;

class OrganizationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Organization::truncate();
        Organization::create([
            'organization_id' => 1,
            'organization_name' => 'UNIVERSITY OF DAR ES SALAAM',
            'organization_phone_number' => '0653470846',
            'organization_email' => 'udsm@udsm.com',
            'organization_address' => '45672'
        ]);

        Organization::create([
            'organization_id' => 2,
            'organization_name' => 'UNIVERSITY OF DODOMA',
            'organization_phone_number' => '0786564524',
            'organization_email' => 'udom@udom.com',
            'organization_address' => '53892'
        ]);

    }
}

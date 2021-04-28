<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Organization;
use Illuminate\Database\Seeder;

class BranchsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Branch::truncate();
        $organization = Organization::find(1);
        $branch = new Branch();
        $branch->branch_id = 1;
        $branch->branch_name = 'MAIN CAMPUS';
        $branch->branch_phone_number = '0789678967';
        $branch->branch_email = "main@udsm.com";
        $branch->branch_address = '34567';
        $organization->branches()->save($branch);

    }
}

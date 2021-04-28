<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Department::truncate();
        $branch = Branch::find(1);
        $department = new Department();
        $department->department_id = 1;
        $department->department_name = 'SOCIAL SCIENCE';
        $department->department_phone_number = '0674565747';
        $department->department_email = 'social@udsm.com';
        $department->department_address = '23465';
        $branch->departments()->save($department);

      
    }
}

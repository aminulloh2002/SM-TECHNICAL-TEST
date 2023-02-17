<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('password'),
        ]);

        $admin->assignRole('admin');

        $approver = User::create([
            'name' => 'Approver 1',
            'email' => 'approver1@mail.com',
            'password' => bcrypt('password'),
        ]);

        $approver->assignRole('approver');

        $approver2 = User::create([
            'name' => 'Approver 2',
            'email' => 'approver2@mail.com',
            'password' => bcrypt('password'),
        ]);

        $approver2->assignRole('approver');

        $approver3 = User::create([
            'name' => 'Approver 3',
            'email' => 'approver3@mail.com',
            'password' => bcrypt('password'),
        ]);

        $approver3->assignRole('approver');

        $supervisor = User::create([
            'name' => 'Supervisor',
            'email' => 'supervisor@mail.com',
            'password' => bcrypt('password'),
        ]);

        $supervisor->assignRole('supervisor');

        // $ss2 = User::create([
        //     'name' => 'Senior Supervisor 2',
        //     'email' => 'ss2@mail.com',
        //     'password' => bcrypt('password'),
        // ]);

        // $ss2->assignRole('supervisor');

        $employee = User::create([
            'name' => 'Employee',
            'email' => 'employee@mail.com',
            'password' => bcrypt('password'),
        ]);

        $employee->assignRole('employee');
    }
}

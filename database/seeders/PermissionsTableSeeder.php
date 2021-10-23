<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Permission::truncate();

        $permissions = [
            0 => [
                'name' => 'role-list',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s")
            ],
            1 => [
                'name' => 'role-create',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s")
            ],
            2 => [
                'name' => 'role-edit',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s")
            ],
            3 => [
                'name' => 'role-delete',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s")
            ],
            4 => [
                'name' => 'patient-list',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s")
            ],
            5 => [
                'name' => 'patient-create',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s")
            ],
            6 => [
                'name' => 'patient-edit',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s")
            ],
            7 => [
                'name' => 'patient-delete',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s")
            ],
            8 => [
                'name' => 'appointment-list',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s")
            ],
            9 => [
                'name' => 'appointment-create',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s")
            ],
            10 => [
                'name' => 'appointment-edit',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s")
            ],
            11 => [
                'name' => 'appointment-delete',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s")
            ],
            12 => [
                'name' => 'doctor-list',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s")
            ],
            13 => [
                'name' => 'doctor-create',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s")
            ],
            14 => [
                'name' => 'doctor-edit',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s")
            ],
            15 => [
                'name' => 'doctor-delete',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s")
            ],
            16 => [
                'name' => 'user-create',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s")
            ],
            17 => [
                'name' => 'user-list',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s")
            ],
            18 => [
                'name' => 'user-edit',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s")
            ],
            19 => [
                'name' => 'user-delete',
                'guard_name' => 'web',
                'created_at' => date("Y-m-d H:i:s")
            ]
        ];
        Permission::insert($permissions);
    }
}

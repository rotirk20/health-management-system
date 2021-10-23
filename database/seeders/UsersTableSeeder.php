<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'dedictarik@hotmail.com',
            'password' => bcrypt('celikovac20'),
        ]);

        DB::table('model_has_roles')->insert([
            'role_id' => 1,
            'model_type' => '\App\Models\User',
            'model_id' => 1,
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array(
            ['id' => '1', 'name' => 'Admin', 'slug' => 'admin'],
            ['id' => '2', 'name' => 'Subscriber', 'slug' => 'subscriber'],
            ['id' => '3', 'name' => 'Author', 'slug' => 'author'],
        );

        foreach ($roles as $role) {
            DB::table('roles')->insert($role);
        }
    }
}

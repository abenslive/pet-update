<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = array([
            'id'=>1,  'username' => 'Abenslive', 'name' => 'Administrator', 'email' => 'admin@admin.com',
            'role_id' => '1', 'password' => Hash::make('password'),
        ], [
            'id'=>2, 'username' => 'Abens','name' => 'Godwin Abenege', 'email' => 'abenegeonline@gmail.com',
            'role_id' => '2', 'password' => Hash::make('password'),
    ]);

        foreach ($users as $user) {
             DB::table('users')->insert($user);
            if ($user['role_id'] == 2){
                $sub = User::find(2);
                $sub->petChannels()->attach(1);
            }
        }
    }
}

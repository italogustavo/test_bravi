<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AddTestUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!DB::table('users')->where('username', 'admin')->first()) {
            DB::table('users')->insert([
                'username' => 'admin',
                'password' => Hash::make('123456'),
                'created_at' => Carbon::now()
            ]);
        }
    }
}

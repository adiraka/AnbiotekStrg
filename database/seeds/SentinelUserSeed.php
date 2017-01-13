<?php

use Illuminate\Database\Seeder;

class SentinelUserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('activations')->delete();

        Sentinel::registerAndActivate([
            'email' => 'admin@admin',
            'password' => 'admin',
            'first_name' => 'Duratun',
            'last_name' => 'Nasihin',
        ]);
    }
}

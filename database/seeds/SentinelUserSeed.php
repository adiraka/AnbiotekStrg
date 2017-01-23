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
            'email' => 'admin@anbiotek.co.id',
            'password' => '@nbi0t3ksa1y0;',
            'first_name' => 'Anbiotek',
            'last_name' => 'Administrator',
        ]);

        Sentinel::registerAndActivate([
            'email' => 'deritandespi@gmail.com',
            'password' => 'andespi01',
            'first_name' => 'Duratun',
            'last_name' => 'Nasihin',
        ]);
    }
}

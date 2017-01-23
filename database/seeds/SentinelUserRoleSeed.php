<?php

use Illuminate\Database\Seeder;

class SentinelUserRoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_users')->delete();

        $adminUser = Sentinel::findByCredentials(['login' => 'admin@anbiotek.co.id']);

        $adminUser2 = Sentinel::findByCredentials(['login' => 'deritandespi@gmail.com']);

        $adminRole = Sentinel::findRoleBySlug('admin');

        $adminRole->users()->attach($adminUser);

        $adminRole->users()->attach($adminUser2);

    }
}

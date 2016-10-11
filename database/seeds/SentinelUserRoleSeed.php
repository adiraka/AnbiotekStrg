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

        $adminUser = Sentinel::findByCredentials(['login' => 'admin@admin']);

        $adminRole = Sentinel::findRoleBySlug('admin');

        $adminRole->users()->attach($adminUser);
    }
}

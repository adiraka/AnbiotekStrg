<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SentinelUserSeed::class);
        $this->call(SentinelRoleSeed::class);
        $this->call(SentinelUserRoleSeed::class);
    }
}

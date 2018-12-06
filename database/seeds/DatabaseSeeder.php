<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(MapSeeder::class);
        $this->call(FloorSeeder::class);
        $this->call(GadgetSeeder::class);
        $this->call(OperatorSeeder::class);
        $this->call(WBSeeder::class);
    }
}

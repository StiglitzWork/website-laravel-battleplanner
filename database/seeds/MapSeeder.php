<?php

use App\Models\Map;

use Illuminate\Database\Seeder;

class MapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Map::create( [
          'name' => "House",
          'thumbsrc' => "/media/house.jpg",
          'imagesrc' => "",
        ] );
    }
}

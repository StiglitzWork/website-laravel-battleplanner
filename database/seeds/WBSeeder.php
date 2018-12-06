<?php

use App\Models\Floor;
use App\Models\Map;

use Illuminate\Database\Seeder;

class WBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $mapArray = [
        /*Fortress*/ ['name'=>"fortress",'thumbsrc'=> "/media/thumbs/fortress.jpg", 'comp'=>true]
      ];
      
      Map::insert($mapArray);

      $floorArray = [
        /*------------------FORTRESS--------------------------------*/
        /*Fortress First*/ ['name'=> "first", 'src'=> "/media/maps/Clean/Fortress/First.png", 'floorNum'=>0, 'map_id'=>Map::byName("fortress")->id],
        /*Fortress Second*/ ['name'=> "second", 'src'=> "/media/maps/Clean/Fortress/Second.png", 'floorNum'=>1, 'map_id'=>Map::byName("fortress")->id],
        /*Fortress Roof*/ ['name'=> "roof", 'src'=> "/media/maps/Clean/Fortress/Roof.png", 'floorNum'=>2, 'map_id'=>Map::byName("fortress")->id]
      ];

      Floor::insert($floorArray);
    }
}

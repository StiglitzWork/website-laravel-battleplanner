<?php

use App\Models\Floor;

use Illuminate\Database\Seeder;

class FloorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $floorArray = [
        /*------------------BANK--------------------------------*/
        /*Bank Basement*/ ['name'=> "basement", 'src'=> "/media/maps/Clean/Bank/Basement.jpg", 'floorNum'=>0, 'map_id'=>1],
        /*Bank First*/ ['name'=> "first", 'src'=> "/media/maps/Clean/Bank/First.jpg", 'floorNum'=>1, 'map_id'=>1],
        /*Bank Second*/ ['name'=> "second", 'src'=> "/media/maps/Clean/Bank/Second.jpg", 'floorNum'=>2, 'map_id'=>1],
        /*Bank Roof*/ ['name'=> "roof", 'src'=> "/media/maps/Clean/Bank/Roof.jpg", 'floorNum'=>3, 'map_id'=>1],

        /*------------------BORDER--------------------------------*/
        /*Border First*/ ['name'=> "first", 'src'=> "/media/maps/Clean/Border/First.jpg", 'floorNum'=>0, 'map_id'=>2],
        /*Border Second*/ ['name'=> "second", 'src'=> "/media/maps/Clean/Border/Second.jpg", 'floorNum'=>1, 'map_id'=>2],
        /*Border Roof*/ ['name'=> "roof", 'src'=> "/media/maps/Clean/Border/Roof.jpg", 'floorNum'=>2, 'map_id'=>2],

        /*------------------COASTLINE--------------------------------*/
        /*Coastline First*/ ['name'=> "first", 'src'=> "/media/maps/Clean/Coastline/First.jpg", 'floorNum'=>0, 'map_id'=>3],
        /*Coastline Second*/ ['name'=> "second", 'src'=> "/media/maps/Clean/Coastline/Second.jpg", 'floorNum'=>1, 'map_id'=>3],
        /*Coastline Roof*/ ['name'=> "roof", 'src'=> "/media/maps/Clean/Coastline/Roof.jpg", 'floorNum'=>2, 'map_id'=>3],

        /*------------------CONSULATE--------------------------------*/
        /*Consulate Basement*/ ['name'=> "basement", 'src'=> "/media/maps/Clean/Consulate/Basement.jpg", 'floorNum'=>0, 'map_id'=>4],
        /*Consulate First*/ ['name'=> "first", 'src'=> "/media/maps/Clean/Consulate/First.jpg", 'floorNum'=>1, 'map_id'=>4],
        /*Consulate Second*/ ['name'=> "second", 'src'=> "/media/maps/Clean/Consulate/Second.jpg", 'floorNum'=>2, 'map_id'=>4],
        /*Consulate Roof*/ ['name'=> "roof", 'src'=> "/media/maps/Clean/Consulate/Roof.jpg", 'floorNum'=>3, 'map_id'=>4],

        /*------------------CHALET--------------------------------*/
        /*Chalet Basement*/ ['name'=> "basement", 'src'=> "/media/maps/Clean/Chalet/Basement.jpg", 'floorNum'=>0, 'map_id'=>5],
        /*Chalet First*/ ['name'=> "first", 'src'=> "/media/maps/Clean/Chalet/First.jpg", 'floorNum'=>1, 'map_id'=>5],
        /*Chalet Second*/ ['name'=> "second", 'src'=> "/media/maps/Clean/Chalet/Second.jpg", 'floorNum'=>2, 'map_id'=>5],
        /*Chalet Roof*/ ['name'=> "roof", 'src'=> "/media/maps/Clean/Chalet/Roof.jpg", 'floorNum'=>3, 'map_id'=>5],

        /*------------------CLUBHOUSE--------------------------------*/
        /*Clubhouse Basement*/ ['name'=> "basement", 'src'=> "/media/maps/Clean/Clubhouse/Basement.jpg", 'floorNum'=>0, 'map_id'=>6],
        /*Clubhouse First*/ ['name'=> "first", 'src'=> "/media/maps/Clean/Clubhouse/First.jpg", 'floorNum'=>1, 'map_id'=>6],
        /*Clubhouse Second*/ ['name'=> "second", 'src'=> "/media/maps/Clean/Clubhouse/Second.jpg", 'floorNum'=>2, 'map_id'=>6],
        /*Clubhouse Roof*/ ['name'=> "roof", 'src'=> "/media/maps/Clean/Clubhouse/Roof.jpg", 'floorNum'=>3, 'map_id'=>6],

        /*------------------KAFE--------------------------------*/
        /*Kafe First*/ ['name'=> "first", 'src'=> "/media/maps/Clean/Kafe/First.jpg", 'floorNum'=>0, 'map_id'=>7],
        /*Kafe Second*/ ['name'=> "second", 'src'=> "/media/maps/Clean/Kafe/Second.jpg", 'floorNum'=>1, 'map_id'=>7],
        /*Kafe Third*/ ['name'=> "third", 'src'=> "/media/maps/Clean/Kafe/Third.jpg", 'floorNum'=>2, 'map_id'=>7],
        /*Kafe Roof*/ ['name'=> "roof", 'src'=> "/media/maps/Clean/Kafe/Roof.jpg", 'floorNum'=>3, 'map_id'=>7],

        /*------------------OREGON--------------------------------*/
        /*Oregon Basement*/ ['name'=> "basement", 'src'=> "/media/maps/Clean/Oregon/Basement.jpg", 'floorNum'=>0, 'map_id'=>8],
        /*Oregon First*/ ['name'=> "first", 'src'=> "/media/maps/Clean/Oregon/First.jpg", 'floorNum'=>1, 'map_id'=>8],
        /*Oregon Second*/ ['name'=> "second", 'src'=> "/media/maps/Clean/Second.jpg", 'floorNum'=>2, 'map_id'=>8],
        /*Oregon Roof*/ ['name'=> "roof", 'src'=> "/media/maps/Clean/Roof.jpg", 'floorNum'=>3, 'map_id'=>8],

        /*------------------SKYSCRAPER--------------------------------*/
        /*Skyscraper First*/ ['name'=> "first", 'src'=> "/media/maps/Clean/Skyscraper/First.jpg", 'floorNum'=>0, 'map_id'=>9],
        /*Skyscraper Second*/ ['name'=> "second", 'src'=> "/media/maps/Clean/Skyscraper/Second.jpg", 'floorNum'=>1, 'map_id'=>9],
        /*Skyscraper Roof*/ ['name'=> "roof", 'src'=> "/media/maps/Clean/Skyscraper/Roof.jpg", 'floorNum'=>2, 'map_id'=>9],

        /*------------------VILLA--------------------------------*/
        /*Villa Basement*/ ['name'=> "basement", 'src'=> "/media/maps/Clean/Villa/Basement.jpg", 'floorNum'=>0, 'map_id'=>10],
        /*Villa First*/ ['name'=> "first", 'src'=> "/media/maps/Clean/Villa/First.jpg", 'floorNum'=>1, 'map_id'=>10],
        /*Villa Second*/ ['name'=> "second", 'src'=> "/media/maps/Clean/Villa/Second.jpg", 'floorNum'=>2, 'map_id'=>10],

        /*------------------THEME PARK--------------------------------*/
        /*Theme Park First*/ ['name'=> "first", 'src'=> "/media/maps/Clean/Theme Park/First.jpg", 'floorNum'=>0, 'map_id'=>11],
        /*Theme Park Second*/ ['name'=> "second", 'src'=> "/media/maps/Clean/Theme Park/Second.jpg", 'floorNum'=>1, 'map_id'=>11],
        /*Theme Park Roof*/ ['name'=> "roof", 'src'=> "/media/maps/Clean/Theme Park/Roof.jpg", 'floorNum'=>2, 'map_id'=>11],

        /*------------------HOUSE--------------------------------*/
        /*House Basement*/ ['name'=> "basement", 'src'=> "/media/maps/Clean/House/Basement.jpg", 'floorNum'=>0, 'map_id'=>12],
        /*House First*/ ['name'=> "first", 'src'=> "/media/maps/Clean/House/First.jpg", 'floorNum'=>1, 'map_id'=>12],
        /*House Second*/ ['name'=> "second", 'src'=> "/media/maps/Clean/House/Second.jpg", 'floorNum'=>2, 'map_id'=>12],
        /*House Roof*/ ['name'=> "roof", 'src'=> "/media/maps/Clean/House/Roof.jpg", 'floorNum'=>2, 'map_id'=>12],

        /*------------------YACHT--------------------------------*/
        /*Yacht Basement*/ ['name'=> "basement", 'src'=> "/media/maps/Clean/Yacht/Basement.png", 'floorNum'=>0, 'map_id'=>13],
        /*Yacht First*/ ['name'=> "first", 'src'=> "/media/maps/Clean/Yacht/First.png", 'floorNum'=>1, 'map_id'=>13],
        /*Yacht Second*/ ['name'=> "second", 'src'=> "/media/maps/Clean/Yacht/Second.png", 'floorNum'=>2, 'map_id'=>13],
        /*Yacht Third*/ ['name'=> "third", 'src'=> "/media/maps/Clean/Yacht/Third.png", 'floorNum'=>3, 'map_id'=>13],
        /*Yacht Roof*/ ['name'=> "roof", 'src'=> "/media/maps/Clean/Yacht/Roof.png", 'floorNum'=>4, 'map_id'=>13],

        /*------------------FAVELA--------------------------------*/
        /*Favela First*/ ['name'=> "first", 'src'=> "/media/maps/Clean/Favela/First.jpg", 'floorNum'=>0, 'map_id'=>14],
        /*Favela Second*/ ['name'=> "second", 'src'=> "/media/maps/Clean/Favela/Second.jpg", 'floorNum'=>1, 'map_id'=>14],
        /*Favela Third*/ ['name'=> "third", 'src'=> "/media/maps/Clean/Favela/Third.jpg", 'floorNum'=>2, 'map_id'=>14],
        /*Favela Roof*/ ['name'=> "roof", 'src'=> "/media/maps/Clean/Favela/Roof.jpg", 'floorNum'=>3, 'map_id'=>14],

        /*------------------TOWER--------------------------------*/
        /*Tower First*/ ['name'=> "first", 'src'=> "/media/maps/Clean/Tower/First.jpg", 'floorNum'=>0, 'map_id'=>15],
        /*Tower Second*/ ['name'=> "second", 'src'=> "/media/maps/Clean/Tower/Second.jpg", 'floorNum'=>1, 'map_id'=>15],
        /*Tower Third*/ ['name'=> "third", 'src'=> "/media/maps/Clean/Tower/Third.jpg", 'floorNum'=>2, 'map_id'=>15],
        /*Tower Roof*/ ['name'=> "roof", 'src'=> "/media/maps/Clean/Tower/Roof.jpg", 'floorNum'=>3, 'map_id'=>15],

        /*------------------PLANE--------------------------------*/
        /*Plane Cargo*/ ['name'=> "basement", 'src'=> "/media/maps/Clean/Plane/Basement.jpg", 'floorNum'=>0, 'map_id'=>16],
        /*Plane First*/ ['name'=> "first", 'src'=> "/media/maps/Clean/Plane/First.jpg", 'floorNum'=>1, 'map_id'=>16],
        /*Plane Second*/ ['name'=> "second", 'src'=> "/media/maps/Clean/Plane/Second.jpg", 'floorNum'=>2, 'map_id'=>16],
        /*Plane Roof*/ ['name'=> "roof", 'src'=> "/media/maps/Clean/Plane/Roof.jpg", 'floorNum'=>3, 'map_id'=>16],

        /*------------------BARTLETT--------------------------------*/
        /*Bartlett First*/ ['name'=> "first", 'src'=> "/media/maps/Clean/Bartlett/First.jpg", 'floorNum'=>0, 'map_id'=>17],
        /*Bartlett Second*/ ['name'=> "second", 'src'=> "/media/maps/Clean/Bartlett/Second.jpg", 'floorNum'=>2, 'map_id'=>17],
        /*Bartlett Roof*/ ['name'=> "roof", 'src'=> "/media/maps/Clean/Bartlett/Roof.jpg", 'floorNum'=>3, 'map_id'=>17],

        /*------------------HEREFORD--------------------------------*/
        /*Hereford Basement*/ ['name'=> "basement", 'src'=> "/media/maps/Clean/Hereford/Basement.jpg", 'floorNum'=>0, 'map_id'=>18],
        /*Hereford First*/ ['name'=> "first", 'src'=> "/media/maps/Clean/Hereford/First.jpg", 'floorNum'=>1, 'map_id'=>18],
        /*Hereford Second*/ ['name'=> "second", 'src'=> "/media/maps/Clean/Hereford/Second.jpg", 'floorNum'=>2, 'map_id'=>18],
        /*Hereford Third*/ ['name'=> "third", 'src'=> "/media/maps/Clean/Hereford/Third.jpg", 'floorNum'=>3, 'map_id'=>18],
        /*Hereford Roof*/ ['name'=> "roof", 'src'=> "/media/maps/Clean/Hereford/Roof.jpg", 'floorNum'=>4, 'map_id'=>18],

        /*------------------KANAL--------------------------------*/
        /*Kanal Basement*/ ['name'=> "first", 'src'=> "/media/maps/Clean/Kanal/Basement.jpg", 'floorNum'=>0, 'map_id'=>19],
        /*Kanal Second*/ ['name'=> "second", 'src'=> "/media/maps/Clean/Kanal/Second.jpg", 'floorNum'=>1, 'map_id'=>19],
        /*Kanal Third*/ ['name'=> "third", 'src'=> "/media/maps/Clean/Kanal/Third.jpg", 'floorNum'=>2, 'map_id'=>19],
        /*Kanal Roof*/ ['name'=> "roof", 'src'=> "/media/maps/Clean/Kanal/Roof.jpg", 'floorNum'=>3, 'map_id'=>19],
      ];

      Floor::insert($floorArray);
    }
}

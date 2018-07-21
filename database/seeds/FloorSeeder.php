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
        /*Bank Basement*/ ['src'=> "media/maps/Bank/Basement.jpg", 'floorNum'=>0, 'map_id'=>1],
        /*Bank First*/ ['src'=> "media/maps/Bank/First.jpg", 'floorNum'=>1, 'map_id'=>1],
        /*Bank Second*/ ['src'=> "media/maps/Bank/Second.jpg", 'floorNum'=>2, 'map_id'=>1],
        /*Bank Roof*/ ['src'=> "media/maps/Bank/Roof.jpg", 'floorNum'=>10, 'map_id'=>1],

        /*------------------BORDER--------------------------------*/
        /*Border First*/ ['src'=> "media/maps/Border/First.jpg", 'floorNum'=>1, 'map_id'=>2],
        /*Border Second*/ ['src'=> "media/maps/Border/Second.jpg", 'floorNum'=>2, 'map_id'=>2],
        /*Border Roof*/ ['src'=> "media/maps/Border/Roof.jpg", 'floorNum'=>10, 'map_id'=>2],

        /*------------------COASTLINE--------------------------------*/
        /*Coastline First*/ ['src'=> "media/maps/Coastline/First.jpg", 'floorNum'=>1, 'map_id'=>3],
        /*Coastline Second*/ ['src'=> "media/maps/Coastline/Second.jpg", 'floorNum'=>2, 'map_id'=>3],
        /*Coastline Roof*/ ['src'=> "media/maps/Coastline/Roof.jpg", 'floorNum'=>10, 'map_id'=>3],

        /*------------------CONSULATE--------------------------------*/
        /*Consulate Basement*/ ['src'=> "media/maps/Consulate/Basement.jpg", 'floorNum'=>0, 'map_id'=>4],
        /*Consulate First*/ ['src'=> "media/maps/Consulate/First.jpg", 'floorNum'=>1, 'map_id'=>4],
        /*Consulate Second*/ ['src'=> "media/maps/Consulate/Second.jpg", 'floorNum'=>2, 'map_id'=>4],

        /*------------------CHALET--------------------------------*/
        /*Chalet Basement*/ ['src'=> "media/maps/Chalet/Basement.jpg", 'floorNum'=>0, 'map_id'=>5],
        /*Chalet First*/ ['src'=> "media/maps/Chalet/First.jpg", 'floorNum'=>1, 'map_id'=>5],
        /*Chalet Second*/ ['src'=> "media/maps/Chalet/Second.jpg", 'floorNum'=>2, 'map_id'=>5],
        /*Chalet Roof*/ ['src'=> "media/maps/Chalet/Roof.jpg", 'floorNum'=>10, 'map_id'=>5],

        /*------------------CLUBHOUSE--------------------------------*/
        /*Clubhouse Basement*/ ['src'=> "media/maps/Clubhouse/Basement.jpg", 'floorNum'=>0, 'map_id'=>6],
        /*Clubhouse First*/ ['src'=> "media/maps/Clubhouse/First.jpg", 'floorNum'=>1, 'map_id'=>6],
        /*Clubhouse Second*/ ['src'=> "media/maps/Clubhouse/Second.jpg", 'floorNum'=>2, 'map_id'=>6],
        /*Clubhouse Roof*/ ['src'=> "media/maps/Clubhouse/Roof.jpg", 'floorNum'=>10, 'map_id'=>6],

        /*------------------KAFE--------------------------------*/
        /*Kafe First*/ ['src'=> "media/maps/Kafe/First.jpg", 'floorNum'=>1, 'map_id'=>7],
        /*Kafe Second*/ ['src'=> "media/maps/Kafe/Second.jpg", 'floorNum'=>2, 'map_id'=>7],
        /*Kafe Third*/ [ 'src'=> "media/maps/Kafe/Third.jpg", 'floorNum'=>3, 'map_id'=>7],
        /*Kafe Roof*/ [ 'src'=> "media/maps/Kafe/Roof.jpg", 'floorNum'=>10, 'map_id'=>7],

        /*------------------OREGON--------------------------------*/
        /*Oregon Basement*/ ['src'=> "media/maps/Oregon/Basement.jpg", 'floorNum'=>0, 'map_id'=>8],
        /*Oregon First*/ ['src'=> "media/maps/Oregon/First.jpg", 'floorNum'=>1, 'map_id'=>8],
        /*Oregon Second*/ ['src'=> "media/maps/Second.jpg", 'floorNum'=>2, 'map_id'=>8],
        /*Oregon Roof*/ ['src'=> "media/maps/Roof.jpg", 'floorNum'=>10, 'map_id'=>8],

        /*------------------SKYSCRAPER--------------------------------*/
        /*Skyscraper First*/ ['src'=> "media/maps/Skyscraper/First.jpg", 'floorNum'=>1, 'map_id'=>9],
        /*Skyscraper Second*/ ['src'=> "media/maps/Skyscraper/Second.jpg", 'floorNum'=>2, 'map_id'=>9],
        /*Skyscraper Roof*/ ['src'=> "media/maps/Skyscraper/Roof.jpg", 'floorNum'=>10, 'map_id'=>9],

        /*------------------VILLA--------------------------------*/
        /*Villa Basement*/ ['src'=> "media/maps/Villa/Basement.jpg", 'floorNum'=>0, 'map_id'=>10],
        /*Villa First*/ ['src'=> "media/maps/Villa/First.jpg", 'floorNum'=>1, 'map_id'=>10],
        /*Villa Second*/ ['src'=> "media/maps/Villa/Second.jpg", 'floorNum'=>2, 'map_id'=>10],

        /*------------------THEME PARK--------------------------------*/
        /*Theme Park First*/ ['src'=> "", 'floorNum'=>1, 'map_id'=>11],
        /*Theme Park Second*/ ['src'=> "", 'floorNum'=>2, 'map_id'=>11],

        /*------------------HOUSE--------------------------------*/
        /*House Basement*/ ['src'=> "media/maps/House/Basement.jpg", 'floorNum'=>0, 'map_id'=>12],
        /*House First*/ ['src'=> "media/maps/House/First.jpg", 'floorNum'=>1, 'map_id'=>12],
        /*House Second*/ ['src'=> "media/maps/House/Second.jpg", 'floorNum'=>2, 'map_id'=>12],
        /*House Roof*/ ['src'=> "media/maps/House/Roof.jpg", 'floorNum'=>10, 'map_id'=>12],

        /*------------------YACHT--------------------------------*/
        /*Yacht Basement*/ ['src'=> "media/maps/Yacht/Basement.png", 'floorNum'=>0, 'map_id'=>13],
        /*Yacht First*/ ['src'=> "media/maps/Yacht/First.png", 'floorNum'=>1, 'map_id'=>13],
        /*Yacht Second*/ ['src'=> "media/maps/Yacht/Second.png", 'floorNum'=>2, 'map_id'=>13],
        /*Yacht Third*/ [ 'src'=> "media/maps/Yacht/Third.png", 'floorNum'=>3, 'map_id'=>13],
        /*Yacht Roof*/ [ 'src'=> "media/maps/Yacht/Roof.png", 'floorNum'=>10, 'map_id'=>13],

        /*------------------FAVELA--------------------------------*/
        /*Favela First*/ ['src'=> "media/maps/Favela/First.jpg", 'floorNum'=>1, 'map_id'=>14],
        /*Favela Second*/ ['src'=> "media/maps/Favela/Second.jpg", 'floorNum'=>2, 'map_id'=>14],
        /*Favela Third*/ ['src'=> "media/maps/Favela/Third.jpg", 'floorNum'=>3, 'map_id'=>14],
        /*Favela Roof*/ ['src'=> "media/maps/Favela/Roof.jpg", 'floorNum'=>10, 'map_id'=>14],

        /*------------------TOWER--------------------------------*/
        /*Tower First*/ ['src'=> "", 'floorNum'=>1, 'map_id'=>15],
        /*Tower Second*/ ['src'=> "", 'floorNum'=>2, 'map_id'=>15],
        /*Tower Third*/ ['src'=> "", 'floorNum'=>3, 'map_id'=>15],

        /*------------------PLANE--------------------------------*/
        /*Plane Cargo*/ ['src'=> "media/maps/Plane/Basement.jpg", 'floorNum'=>0, 'map_id'=>16],
        /*Plane First*/ ['src'=> "media/maps/Plane/First.jpg", 'floorNum'=>1, 'map_id'=>16],
        /*Plane Second*/ ['src'=> "media/maps/Plane/Second.jpg", 'floorNum'=>2, 'map_id'=>16],
        /*Plane Roof*/ ['src'=> "media/maps/Plane/Roof.jpg", 'floorNum'=>10, 'map_id'=>16],

        /*------------------BARTLETT--------------------------------*/
        /*Bartlett First*/ ['src'=> "", 'floorNum'=>1, 'map_id'=>17],
        /*Bartlett Second*/ ['src'=> "", 'floorNum'=>2, 'map_id'=>17],

        /*------------------HEREFORD--------------------------------*/
        /*Hereford Basement*/ ['src'=> "media/maps/Hereford/Basement.jpg", 'floorNum'=>0, 'map_id'=>18],
        /*Hereford First*/ ['src'=> "media/maps/Hereford/First.jpg", 'floorNum'=>1, 'map_id'=>18],
        /*Hereford Second*/ ['src'=> "media/maps/Hereford/Second.jpg", 'floorNum'=>2, 'map_id'=>18],
        /*Hereford Third*/ ['src'=> "media/maps/Hereford/Third.jpg", 'floorNum'=>3, 'map_id'=>18],
        /*Hereford Third*/ ['src'=> "media/maps/Hereford/Roof.jpg", 'floorNum'=>3, 'map_id'=>18],

        /*------------------KANAL--------------------------------*/
        /*Kanal Basement*/ ['src'=> "media/maps/Kanal/Basement.jpg", 'floorNum'=>0, 'map_id'=>19],
        /*Kanal Second*/ ['src'=> "media/maps/Kanal/Second.jpg", 'floorNum'=>2, 'map_id'=>19],
        /*Kanal Third*/ ['src'=> "media/maps/Kanal/Third.jpg", 'floorNum'=>3, 'map_id'=>19],
        /*Kanal Roof*/ ['src'=> "media/maps/Kanal/Roof.jpg", 'floorNum'=>3, 'map_id'=>19],
      ];

      Floor::insert($floorArray);
    }
}

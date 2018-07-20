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
        /*Bank Basement*/ ['src'=> "", 'floorNum'=>0, 'map_id'=>1],
        /*Bank First*/ ['src'=> "", 'floorNum'=>1, 'map_id'=>1],
        /*Bank Second*/ ['src'=> "", 'floorNum'=>2, 'map_id'=>1],
        /*Bank Roof*/ ['src'=> "", 'floorNum'=>10, 'map_id'=>1],

        /*------------------BORDER--------------------------------*/
        /*Border First*/ ['src'=> "", 'floorNum'=>1, 'map_id'=>2],
        /*Border Second*/ ['src'=> "", 'floorNum'=>2, 'map_id'=>2],
        /*Border Roof*/ ['src'=> "", 'floorNum'=>10, 'map_id'=>2],

        /*------------------COASTLINE--------------------------------*/
        /*Coastline First*/ ['src'=> "", 'floorNum'=>1, 'map_id'=>3],
        /*Coastline Second*/ ['src'=> "", 'floorNum'=>2, 'map_id'=>3],
        /*Coastline Roof*/ ['src'=> "", 'floorNum'=>10, 'map_id'=>3],

        /*------------------CONSULATE--------------------------------*/
        /*Consulate Basement*/ ['src'=> "", 'floorNum'=>0, 'map_id'=>4],
        /*Consulate First*/ ['src'=> "", 'floorNum'=>1, 'map_id'=>4],
        /*Consulate Second*/ ['src'=> "", 'floorNum'=>2, 'map_id'=>4],
        /*Consulate Roof*/ ['src'=> "", 'floorNum'=>10, 'map_id'=>4],

        /*------------------CHALET--------------------------------*/
        /*Chalet Basement*/ ['src'=> "", 'floorNum'=>0, 'map_id'=>5],
        /*Chalet First*/ ['src'=> "", 'floorNum'=>1, 'map_id'=>5],
        /*Chalet Second*/ ['src'=> "", 'floorNum'=>2, 'map_id'=>5],

        /*------------------CLUBHOUSE--------------------------------*/
        /*Clubhouse Basement*/ ['src'=> "", 'floorNum'=>0, 'map_id'=>6],
        /*Clubhouse First*/ ['src'=> "", 'floorNum'=>1, 'map_id'=>6],
        /*Clubhouse Second*/ ['src'=> "", 'floorNum'=>2, 'map_id'=>6],
        /*Clubhouse Roof*/ ['src'=> "", 'floorNum'=>10, 'map_id'=>6],

        /*------------------KAFE--------------------------------*/
        /*Kafe First*/ ['src'=> "", 'floorNum'=>1, 'map_id'=>7],
        /*Kafe Second*/ ['src'=> "", 'floorNum'=>2, 'map_id'=>7],
        /*Kafe Third*/ [ 'src'=>"", 'floorNum'=>3, 'map_id'=>7],
        /*Kafe Roof*/ ['src'=> "", 'floorNum'=>10, 'map_id'=>7],

        /*------------------OREGON--------------------------------*/
        /*Oregon Basement*/ ['src'=> "", 'floorNum'=>0, 'map_id'=>8],
        /*Oregon First*/ ['src'=> "", 'floorNum'=>1, 'map_id'=>8],
        /*Oregon Second*/ ['src'=> "", 'floorNum'=>2, 'map_id'=>8],
        /*Oregon Tower*/ ['src'=>"", 'floorNum'=>3, 'map_id'=>8],
        /*Oregon Roof*/ ['src'=> "", 'floorNum'=>10, 'map_id'=>8],

        /*------------------SKYSCRAPER--------------------------------*/
        /*Skyscraper First*/ ['src'=> "", 'floorNum'=>1, 'map_id'=>9],
        /*Skyscraper Second*/ ['src'=> "", 'floorNum'=>2, 'map_id'=>9],

        /*------------------VILLA--------------------------------*/
        /*Villa Basement*/ ['src'=> "", 'floorNum'=>0, 'map_id'=>10],
        /*Villa First*/ ['src'=> "", 'floorNum'=>1, 'map_id'=>10],
        /*Villa Second*/ ['src'=> "", 'floorNum'=>2, 'map_id'=>10],
        /*Villa Roof*/ ['src'=> "", 'floorNum'=>10, 'map_id'=>10],

        /*------------------THEME PARK--------------------------------*/
        /*Theme Park First*/ ['src'=> "", 'floorNum'=>1, 'map_id'=>11],
        /*Theme Park Second*/ ['src'=> "", 'floorNum'=>2, 'map_id'=>11],
        /*Theme Park Roof*/ ['src'=> "", 'floorNum'=>10, 'map_id'=>11],

        /*------------------HOUSE--------------------------------*/
        /*House Basement*/ ['src'=> "", 'floorNum'=>0, 'map_id'=>12],
        /*House First*/ ['src'=> "", 'floorNum'=>1, 'map_id'=>12],
        /*House Second*/ ['src'=> "", 'floorNum'=>2, 'map_id'=>12],
        /*House Roof*/ ['src'=> "", 'floorNum'=>10, 'map_id'=>12],

        /*------------------YACHT--------------------------------*/
        /*Yacht Basement*/ ['src'=> "", 'floorNum'=>0, 'map_id'=>13],
        /*Yacht First*/ ['src'=> "", 'floorNum'=>1, 'map_id'=>13],
        /*Yacht Second*/ ['src'=> "", 'floorNum'=>2, 'map_id'=>13],
        /*Yacht Third*/ [ 'src'=>"", 'floorNum'=>3, 'map_id'=>13],
        /*Yacht Roof*/ ['src'=> "", 'floorNum'=>10, 'map_id'=>13],

        /*------------------FAVELA--------------------------------*/
        /*Favela First*/ ['src'=> "", 'floorNum'=>1, 'map_id'=>14],
        /*Favela Second*/ ['src'=> "", 'floorNum'=>2, 'map_id'=>14],
        /*Favela Third*/ ['src'=> "", 'floorNum'=>3, 'map_id'=>14],
        /*Favela Roof*/ ['src'=> "", 'floorNum'=>10, 'map_id'=>14],

        /*------------------TOWER--------------------------------*/
        /*Tower First*/ ['src'=> "", 'floorNum'=>1, 'map_id'=>15],
        /*Tower Second*/ ['src'=> "", 'floorNum'=>2, 'map_id'=>15],
        /*Tower Third*/ ['src'=> "", 'floorNum'=>3, 'map_id'=>15],
        /*Tower Roof*/ ['src'=> "", 'floorNum'=>10, 'map_id'=>15],

        /*------------------PLANE--------------------------------*/
        /*Plane Cargo*/ ['src'=> "", 'floorNum'=>0, 'map_id'=>16],
        /*Plane First*/ ['src'=> "", 'floorNum'=>1, 'map_id'=>16],
        /*Plane Second*/ ['src'=> "", 'floorNum'=>2, 'map_id'=>16],

        /*------------------BARTLETT--------------------------------*/
        /*Bartlett First*/ ['src'=> "", 'floorNum'=>1, 'map_id'=>17],
        /*Bartlett Second*/ ['src'=> "", 'floorNum'=>2, 'map_id'=>17],
        /*Bartlett Roof*/ ['src'=> "", 'floorNum'=>10, 'map_id'=>17],

        /*------------------HEREFORD--------------------------------*/
        /*Hereford Basement*/ ['src'=> "", 'floorNum'=>0, 'map_id'=>18],
        /*Hereford First*/ ['src'=> "", 'floorNum'=>1, 'map_id'=>18],
        /*Hereford Second*/ ['src'=> "", 'floorNum'=>2, 'map_id'=>18],
        /*Hereford Third*/ ['src'=> "", 'floorNum'=>3, 'map_id'=>18],
        /*Hereford Roof*/ ['src'=> "", 'floorNum'=>10, 'map_id'=>18],

        /*------------------KANAL--------------------------------*/
        /*Kanal Basement*/ ['src'=> "", 'floorNum'=>0, 'map_id'=>19],
        /*Kanal First*/ ['src'=> "", 'floorNum'=>1, 'map_id'=>19],
        /*Kanal Second*/ ['src'=> "", 'floorNum'=>2, 'map_id'=>19],
        /*Kanal Roof*/ ['src'=> "", 'floorNum'=>10, 'map_id'=>19],
      ];

      Floor::insert($floorArray);
    }
}

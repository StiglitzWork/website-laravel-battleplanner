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
        /*Bank Basement*/ ['map'=>"bank",'src'=> "", 'floorNum'=>0],
        /*Bank First*/ ['map'=>"bank",'src'=> "", 'floorNum'=>1],
        /*Bank Second*/ ['map'=>"bank",'src'=> "", 'floorNum'=>2],
        /*Bank Roof*/ ['map'=>"bank",'src'=> "", 'floorNum'=>10],

        /*------------------BORDER--------------------------------*/
        /*Border First*/ ['map'=>"border",'src'=> "", 'floorNum'=>1],
        /*Border Second*/ ['map'=>"border",'src'=> "", 'floorNum'=>2],
        /*Border Roof*/ ['map'=>"border",'src'=> "", 'floorNum'=>10],

        /*------------------COASTLINE--------------------------------*/
        /*Coastline First*/ ['map'=>"coastline",'src'=> "", 'floorNum'=>1],
        /*Coastline Second*/ ['map'=>"coastline",'src'=> "", 'floorNum'=>2],
        /*Coastline Roof*/ ['map'=>"coastline",'src'=> "", 'floorNum'=>10],

        /*------------------CONSULATE--------------------------------*/
        /*Consulate Basement*/ ['map'=>"consulate",'src'=> "", 'floorNum'=>0],
        /*Consulate First*/ ['map'=>"consulate",'src'=> "", 'floorNum'=>1],
        /*Consulate Second*/ ['map'=>"consulate",'src'=> "", 'floorNum'=>2],
        /*Consulate Roof*/ ['map'=>"consulate",'src'=> "", 'floorNum'=>10],

        /*------------------CHALET--------------------------------*/
        /*Chalet Basement*/ ['map'=>"chalet",'src'=> "", 'floorNum'=>0],
        /*Chalet First*/ ['map'=>"chalet",'src'=> "", 'floorNum'=>1],
        /*Chalet Second*/ ['map'=>"chalet",'src'=> "", 'floorNum'=>2],

        /*------------------CLUBHOUSE--------------------------------*/
        /*Clubhouse Basement*/ ['map'=>"clubhouse",'src'=> "", 'floorNum'=>0],
        /*Clubhouse First*/ ['map'=>"clubhouse",'src'=> "", 'floorNum'=>1],
        /*Clubhouse Second*/ ['map'=>"clubhouse",'src'=> "", 'floorNum'=>2],
        /*Clubhouse Roof*/ ['map'=>"clubhouse",'src'=> "", 'floorNum'=>10],

        /*------------------KAFE--------------------------------*/
        /*Kafe First*/ ['map'=>"kafe",'src'=> "", 'floorNum'=>1],
        /*Kafe Second*/ ['map'=>"kafe",'src'=> "", 'floorNum'=>2],
        /*Kafe Third*/ ['map'=>"kafe", 'src'=>"", 'floorNum'=>3],
        /*Kafe Roof*/ ['map'=>"kafe",'src'=> "", 'floorNum'=>10],

        /*------------------OREGON--------------------------------*/
        /*Oregon Basement*/ ['map'=>"oregon",'src'=> "", 'floorNum'=>0],
        /*Oregon First*/ ['map'=>"oregon",'src'=> "", 'floorNum'=>1],
        /*Oregon Second*/ ['map'=>"oregon",'src'=> "", 'floorNum'=>2],
        /*Oregon Tower*/ ['map'=>"oregon", 'src'=>"", 'floorNum'=>3],
        /*Oregon Roof*/ ['map'=>"consulate",'src'=> "", 'floorNum'=>10],

        /*------------------SKYSCRAPER--------------------------------*/
        /*Skyscraper First*/ ['map'=>"skyscraper",'src'=> "", 'floorNum'=>1],
        /*Skyscraper Second*/ ['map'=>"skyscraper",'src'=> "", 'floorNum'=>2],

        /*------------------VILLA--------------------------------*/
        /*Villa Basement*/ ['map'=>"villa",'src'=> "", 'floorNum'=>0],
        /*Villa First*/ ['map'=>"villa",'src'=> "", 'floorNum'=>1],
        /*Villa Second*/ ['map'=>"villa",'src'=> "", 'floorNum'=>2],
        /*Villa Roof*/ ['map'=>"villa",'src'=> "", 'floorNum'=>10],

        /*------------------THEME PARK--------------------------------*/
        /*Theme Park First*/ ['map'=>"theme park",'src'=> "", 'floorNum'=>1],
        /*Theme Park Second*/ ['map'=>"theme park",'src'=> "", 'floorNum'=>2],
        /*Theme Park Roof*/ ['map'=>"theme park",'src'=> "", 'floorNum'=>10],

        /*------------------HOUSE--------------------------------*/
        /*House Basement*/ ['map'=>"house",'src'=> "", 'floorNum'=>0],
        /*House First*/ ['map'=>"house",'src'=> "", 'floorNum'=>1],
        /*House Second*/ ['map'=>"house",'src'=> "", 'floorNum'=>2],
        /*House Roof*/ ['map'=>"house",'src'=> "", 'floorNum'=>10],

        /*------------------YACHT--------------------------------*/
        /*Yacht Basement*/ ['map'=>"yacht",'src'=> "", 'floorNum'=>0],
        /*Yacht First*/ ['map'=>"yacht",'src'=> "", 'floorNum'=>1],
        /*Yacht Second*/ ['map'=>"yacht",'src'=> "", 'floorNum'=>2],
        /*Yacht Third*/ ['map'=>"yacht", 'src'=>"", 'floorNum'=>3],
        /*Yacht Roof*/ ['map'=>"yacht",'src'=> "", 'floorNum'=>10],

        /*------------------FAVELA--------------------------------*/
        /*Favela First*/ ['map'=>"favela",'src'=> "", 'floorNum'=>1],
        /*Favela Second*/ ['map'=>"favela",'src'=> "", 'floorNum'=>2],
        /*Favela Third*/ ['map'=>"favela",'src'=> "", 'floorNum'=>3],
        /*Favela Roof*/ ['map'=>"favela",'src'=> "", 'floorNum'=>10],

        /*------------------TOWER--------------------------------*/
        /*Tower First*/ ['map'=>"tower",'src'=> "", 'floorNum'=>1],
        /*Tower Second*/ ['map'=>"tower",'src'=> "", 'floorNum'=>2],
        /*Tower Third*/ ['map'=>"tower",'src'=> "", 'floorNum'=>3],
        /*Tower Roof*/ ['map'=>"tower",'src'=> "", 'floorNum'=>10],

        /*------------------PLANE--------------------------------*/
        /*Plane Cargo*/ ['map'=>"plane",'src'=> "", 'floorNum'=>0],
        /*Plane First*/ ['map'=>"plane",'src'=> "", 'floorNum'=>1],
        /*Plane Second*/ ['map'=>"plane",'src'=> "", 'floorNum'=>2],

        /*------------------BARTLETT--------------------------------*/
        /*Bartlett First*/ ['map'=>"bartlett",'src'=> "", 'floorNum'=>1],
        /*Bartlett Second*/ ['map'=>"bartlett",'src'=> "", 'floorNum'=>2],
        /*Bartlett Roof*/ ['map'=>"bartlett",'src'=> "", 'floorNum'=>10],

        /*------------------HEREFORD--------------------------------*/
        /*Hereford Basement*/ ['map'=>"hereford",'src'=> "", 'floorNum'=>0],
        /*Hereford First*/ ['map'=>"hereford",'src'=> "", 'floorNum'=>1],
        /*Hereford Second*/ ['map'=>"hereford",'src'=> "", 'floorNum'=>2],
        /*Hereford Third*/ ['map'=>"hereford",'src'=> "", 'floorNum'=>3],
        /*Hereford Roof*/ ['map'=>"hereford",'src'=> "", 'floorNum'=>10],

        /*------------------KANAL--------------------------------*/
        /*Kanal Basement*/ ['map'=>"kanal",'src'=> "", 'floorNum'=>0],
        /*Kanal First*/ ['map'=>"kanal",'src'=> "", 'floorNum'=>1],
        /*Kanal Second*/ ['map'=>"kanal",'src'=> "", 'floorNum'=>2],
        /*Kanal Roof*/ ['map'=>"kanal",'src'=> "", 'floorNum'=>10],
      ];

      Floor::insert($floorArray);
    }
}

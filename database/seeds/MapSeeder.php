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
        $mapArray = [
          /*Bank*/ ['name'=>"bank",'thumbsrc'=> "media/thumbs/200x100.jpg", 'comp'=>true],
          /*Border*/ ['name'=>"border",'thumbsrc'=> "media/thumbs/200x100.jpg", 'comp'=>true],
          /*Coastline*/ ['name'=>"coastline",'thumbsrc'=> "media/thumbs/200x100.jpg", 'comp'=>true],
          /*Consulate*/ ['name'=>"consulate",'thumbsrc'=> "media/thumbs/200x100.jpg", 'comp'=>true],
          /*Chalet*/ ['name'=>"chalet",'thumbsrc'=> "media/thumbs/200x100.jpg", 'comp'=>true],
          /*Clubhouse*/ ['name'=>"clubhouse",'thumbsrc'=> "media/thumbs/200x100.jpg", 'comp'=>true],
          /*Kafe*/ ['name'=>"kafe",'thumbsrc'=> "media/thumbs/200x100.jpg", 'comp'=>true],
          /*Oregon*/ ['name'=>"oregon",'thumbsrc'=> "media/thumbs/200x100.jpg", 'comp'=>true],
          /*Skyscraper*/ ['name'=>"skyscraper",'thumbsrc'=> "media/thumbs/200x100.jpg", 'comp'=>true],
          /*Villa*/ ['name'=>"villa",'thumbsrc'=> "media/thumbs/200x100.jpg", 'comp'=>true],
          /*Theme Park*/ ['name'=>"theme park",'thumbsrc'=> "media/thumbs/200x100.jpg", 'comp'=>true],
          /*House*/ ['name'=>"house",'thumbsrc'=> "media/thumbs/200x100.jpg", 'comp'=>false],
          /*Yacht*/ ['name'=>"yacht",'thumbsrc'=> "media/thumbs/200x100.jpg", 'comp'=>false],
          /*Favela*/ ['name'=>"favela",'thumbsrc'=> "media/thumbs/200x100.jpg", 'comp'=>false],
          /*Tower*/ ['name'=>"tower",'thumbsrc'=> "media/thumbs/200x100.jpg", 'comp'=>false],
          /*Plane*/ ['name'=>"plane",'thumbsrc'=> "media/thumbs/200x100.jpg", 'comp'=>false],
          /*Bartlett*/ ['name'=>"bartlett",'thumbsrc'=> "media/thumbs/200x100.jpg", 'comp'=>false],
          /*Hereford*/ ['name'=>"hereford",'thumbsrc'=> "media/thumbs/200x100.jpg", 'comp'=>false],
          /*Kanal*/ ['name'=>"kanal",'thumbsrc'=> "media/thumbs/200x100.jpg", 'comp'=>false],
        ];

        Map::insert($mapArray);
    }
}

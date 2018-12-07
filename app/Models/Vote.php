<?php

namespace App\Models;

use App\Models\OperatorSlot;
use App\Models\Map;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = [
        'value', 'user_id', "battleplan_id"
    ];

    /*****
    searches
    *****/
    public static function search($user,$battleplan){
        return Vote::where("user_id", $user->id)
            ->where("battleplan_id", $battleplan->id)
            ->first();
    }
    
    /*****
    Relationships
    *****/

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id');
    }

    public function battleplan()
    {
        return $this->belongsTo('App\Models\Battleplan');
    }
}

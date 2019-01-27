<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Character_Tag extends Model
{
    public function character(){
        return $this->belongsTo('App\Character');
    }
    
    public function tag(){
        return $this->belongsTo('App\Tag');
    }
}

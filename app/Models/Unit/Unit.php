<?php

namespace App\Models\Unit;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //

    public function scopeArchive($query){
    	return $query->where('archive',1);
    }

    public function scopeActive($query){
    	return $query->where('archive',0);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubGroup extends Model
{
    protected $guarded = False;
    
    public function group() {
        $this->belongsTo('group');
    }
}

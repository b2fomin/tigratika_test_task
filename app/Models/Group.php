<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $guarded = False;
    public function sub_groups() {
        return $this->hasMany('sub_group');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $guarded = False;
    public function sub_groups() {
        return $this->hasMany(SubGroup::class);
    }
}

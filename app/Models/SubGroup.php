<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubGroup extends Model
{
    use HasFactory;
    protected $guarded = False;
    
    public function group() {
        $this->belongsTo(Group::class);
    }
}

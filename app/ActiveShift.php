<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActiveShift extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function guards()
    {
        return $this->belongsToMany(Guard::class);
    }
}

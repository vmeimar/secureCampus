<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActiveShift extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $attributes = [
        'confirmed' =>  0
    ];

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function guards()
    {
        return $this->belongsToMany(Guard::class);
    }
}

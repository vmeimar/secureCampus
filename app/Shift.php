<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $guarded = [];

    public function guards()
    {
        return $this->belongsToMany(Guard::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function guarded()
    {
        return $this->belongsToMany(Guard::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}

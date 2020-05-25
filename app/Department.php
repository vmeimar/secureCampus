<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}

<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $guarded = [];

    public function guards()
    {
        return $this->hasMany(Guard::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function guarded()
    {
        return $this->belongsToMany(Guard::class)->withPivot(['shiftDate']);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function activeShifts()
    {
        return $this->hasMany(ActiveShift::class);
    }
}

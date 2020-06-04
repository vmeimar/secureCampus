<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guard extends Model
{
    protected $guarded = [];

    protected $attributes = [
        'active'    =>  1
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function guarding()
    {
        return $this->belongsToMany(Shift::class)->withPivot(['shiftDate']);
    }

    public function activeShifts()
    {
        return $this->belongsToMany(ActiveShift::class);
    }
}

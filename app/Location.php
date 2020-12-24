<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Contract
 * @package App
 * @mixin Builder
 */
class Location extends Model
{
    protected $guarded = [];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function activeShifts()
    {
        return $this->hasMany(ActiveShift::class);
    }

    public function shifts()
    {
        return $this->hasMany(Shift::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}

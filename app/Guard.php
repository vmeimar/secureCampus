<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Contract
 * @package App
 * @mixin Builder
 */
class Guard extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $attributes = [
        'active'    =>  1
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function activeShifts()
    {
        return $this->belongsToMany(ActiveShift::class)->withTimestamps();
    }
}

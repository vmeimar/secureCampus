<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Contract
 * @package App
 * @mixin Builder
 */
class Company extends Model
{
    protected $guarded = [];

    protected $attributes = [
        'active'    =>  1
    ];

    public function guards()
    {
        return $this->hasMany(Guard::class);
    }
}

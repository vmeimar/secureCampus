<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

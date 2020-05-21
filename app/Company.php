<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $guarded = [];

    public function guards()
    {
        return $this->hasMany(Guard::class);
    }
}

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
}

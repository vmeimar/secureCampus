<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guard extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        self::created( function ($guard) {
            $guard->create([
                'active' =>  1
            ]);
        } );
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}

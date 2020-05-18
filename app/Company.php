<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function guards()
    {
        return $this->hasMany(Guard::class);
    }

    public function departments()
    {

    }
}

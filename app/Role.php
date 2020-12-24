<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Contract
 * @package App
 * @mixin Builder
 */
class Role extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}

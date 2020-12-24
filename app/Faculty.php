<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Contract
 * @package App
 * @mixin Builder
 */
class Faculty extends Model
{
    public function departments()
    {
        return $this->hasMany(Department::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Parameter extends Model
{
    public $allowedSorts = [];
    
    protected $table = 'parameters';
    protected $primaryKey = 'idParameter';
    protected $perPage = 1000000;

    public function parameterType()
    {
        return $this->hasOne(ParameterType::class, 'idParameterType', 'idParameterType');
    }

    public function scopeIdParameterType(Builder $query, $value)
    {
        $query->where('idParameterType', $value);
    }
}

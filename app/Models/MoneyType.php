<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class MoneyType extends Model
{
    public $allowedSorts = [];
    
    protected $table = 'money_types';
    protected $primaryKey = 'idMoneyType';
    protected $perPage = 1000000;

    public function scopeIdMoneyType(Builder $query, $value)
    {
        $query->where('idMoneyType', $value);
    }
}

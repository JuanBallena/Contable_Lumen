<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Account extends Model
{
    public $allowedSorts = [];

    protected $table = 'accounts';
    protected $primaryKey = 'idAccount';
    protected $perPage = 1000000;
    public $timestamps = false;

    public function accountType()
    {
        return $this->hasOne(AccountType::class, 'idAccountType', 'idAccountType');
    }

    public function scopeNumber(Builder $query, $value)
    {
        $query->where('number', 'LIKE', '%'.$value.'%');
    }

    public function operationType()
    {
        return $this->hasOne(OperationType::class, 'idOperationType', 'idOperationType');
    }
}

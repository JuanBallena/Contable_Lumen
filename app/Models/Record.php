<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Record extends Model
{
    public $allowedSorts = [];

    protected $dates = ['voucherDate', 'createdAt', 'updatedAt'];

    protected $table = 'records';
    protected $primaryKey = 'idRecord';
    protected $perPage = 1000000;
    public $timestamps = false;

    public function scopeIdRecord(Builder $query, $value)
    {
        $query->where('idRecord', $value);
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, 'idCustomer', 'idCustomer');
    }

    public function month()
    {
        return $this->hasOne(Month::class, 'idMonth', 'idMonth');
    }

    public function moneyType()
    {
        return $this->hasOne(MoneyType::class, 'idMoneyType', 'idMoneyType');
    }

    public function voucherType()
    {
        return $this->hasOne(VoucherType::class, 'idVoucherType', 'idVoucherType');
    }

    public function recordType()
    {
        return $this->hasOne(Parameter::class, 'idParameter', 'id001RecordType');
    }

    public function accounts()
    {
        return $this->hasMany(RecordAccount::class, 'idRecord', 'idRecord');
    }
}

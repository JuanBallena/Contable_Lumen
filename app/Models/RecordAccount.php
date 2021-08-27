<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecordAccount extends Model
{
    protected $table = 'record_accounts';
    protected $primaryKey = 'idRecordAccount';
    public $timestamps = false;

    public function record()
    {
        return $this->hasOne(Record::class, 'idRecord', 'idRecord');
    }

    public function account()
    {
        return $this->hasOne(Account::class, 'idAccount', 'idAccount');
    }

    public function amountType()
    {
        return $this->hasOne(Parameter::class, 'idParameter', 'id002AmountType');
    }
}
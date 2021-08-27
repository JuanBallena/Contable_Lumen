<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountGroup extends Model
{
    public $allowedSorts = [];
    
    protected $table = 'account_groups';

    public function mainAccount()
    {
        return $this->hasOne(MainAccount::class, 'idMainAccount', 'idMainAccount');
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




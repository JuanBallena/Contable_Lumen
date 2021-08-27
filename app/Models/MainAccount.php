<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainAccount extends Model
{    
    protected $table = 'main_accounts';
    protected $primaryKey = 'idMainAccount';

    public function account()
    {
        return $this->hasOne(Account::class, 'idAccount', 'idAccount');
    }

    public function accountsGroup()
    {
        return $this->hasMany(AccountGroup::class, 'idMainAccount', 'idMainAccount');
    }
}

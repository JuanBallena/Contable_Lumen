<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class VoucherType extends Model
{
    public $allowedSorts = [];
    
    protected $table = 'voucher_types';
    protected $primaryKey = 'idVoucherType';
    protected $perPage = 1000000;

    public function scopeIdVoucherType(Builder $query, $value)
    {
        $query->where('idVoucherType', $value);
    }
}

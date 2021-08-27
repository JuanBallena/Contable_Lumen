<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Customer extends Model
{
    public $allowedSorts = [];
    
    protected $table = 'customers';
    protected $primaryKey = 'idCustomer';
    protected $perPage = 1000000;
    public $timestamps = false;

    public function scopeIdCustomer(Builder $query, $value)
    {
        $query->where('idCustomer', $value);
    }

    public function documentType()
    {
        return $this->hasOne(DocumentType::class, 'idDocumentType', 'idDocumentType');
    }
}

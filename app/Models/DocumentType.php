<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    const DNI = 1;
    const RUC = 2;
    
    public $allowedSorts = [];
    
    protected $table = 'document_types';
    protected $primaryKey = 'idDocumentType';
    protected $perPage = 1000000;

    public function scopeIdDocumentType(Builder $query, $value)
    {
        $query->where('idDocumentType', $value);
    }
}

<?php

namespace App\Http\Controllers\DocumentType;

use App\Http\Controllers\Controller;
use App\Http\Resources\DocumentTypeResource;
use App\JsonApi\ServiceResponse;
use App\Models\DocumentType;

class DocumentTypeListController extends Controller
{
    public function toList()
    {
        $documentTypes = DocumentType::applyFilters()->applySorts()->jsonPaginate();

        $documentTypesResource = DocumentTypeResource::collection($documentTypes);
        $pages = count($documentTypesResource) > 0 ? 1 : 0;
        
        return ServiceResponse::ok($documentTypesResource, $pages);
    }
}

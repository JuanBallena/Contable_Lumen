<?php

namespace App\Http\Controllers\Record;

use App\Http\Controllers\Controller;
use App\Http\Resources\RecordResource;
use App\JsonApi\ServiceResponse;
use App\Models\Record;

class RecordListController extends Controller
{
    public function toList()
    {
        $records = Record::applyFilters()->applySorts()->jsonPaginate();

        $recordsResource = RecordResource::collection($records);
        $pages = count($recordsResource) > 0 ? $recordsResource->lastPage() : 0;

        return ServiceResponse::ok($recordsResource, $pages);
    }
}

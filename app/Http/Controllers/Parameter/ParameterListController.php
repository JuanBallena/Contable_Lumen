<?php

namespace App\Http\Controllers\Parameter;

use App\Http\Controllers\Controller;
use App\Http\Resources\ParameterResource;
use App\JsonApi\ServiceResponse;
use App\Models\Parameter;

class ParameterListController extends Controller
{
    public function toList()
    {
        $parameters = Parameter::applyFilters()->applySorts()->jsonPaginate();

        $parametersResource = ParameterResource::collection($parameters);
        $pages = count($parametersResource) > 0 ? $parametersResource->lastPage() : 0;
        
        return ServiceResponse::ok($parametersResource, $pages);
    }
}

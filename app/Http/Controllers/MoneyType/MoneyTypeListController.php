<?php

namespace App\Http\Controllers\MoneyType;

use App\Http\Controllers\Controller;
use App\Http\Resources\MoneyTypeResource;
use App\JsonApi\ServiceResponse;
use App\Models\MoneyType;

class MoneyTypeListController extends Controller
{
    public function toList()
    {
        $moneyTypes = MoneyType::applyFilters()->applySorts()->jsonPaginate();

        $moneyTypesResource = MoneyTypeResource::collection($moneyTypes);
        $pages = count($moneyTypesResource) > 0 ? 1 : 0;
        
        return ServiceResponse::ok($moneyTypesResource, $pages);
    }
}

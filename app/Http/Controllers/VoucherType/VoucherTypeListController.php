<?php

namespace App\Http\Controllers\VoucherType;

use App\Http\Controllers\Controller;
use App\Http\Resources\VoucherTypeResource;
use App\JsonApi\ServiceResponse;
use App\Models\VoucherType;

class VoucherTypeListController extends Controller
{
    public function toList()
    {
        $voucherTypes = VoucherType::applyFilters()->applySorts()->jsonPaginate();
        
        $voucherTypesResource = VoucherTypeResource::collection($voucherTypes);
        $pages = count($voucherTypesResource) > 0 ? 1 : 0;
        
        return ServiceResponse::ok($voucherTypesResource, $pages);
    }
}

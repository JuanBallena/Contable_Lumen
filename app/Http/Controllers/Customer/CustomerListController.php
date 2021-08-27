<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\JsonApi\ServiceResponse;
use App\Models\Customer;

class CustomerListController extends Controller
{
    public function toList()
    {
        $customers = Customer::applyFilters()->applySorts()->jsonPaginate();

        $customersResource = CustomerResource::collection($customers);
        $pages = count($customersResource) > 0 ? $customersResource->lastPage() : 0;

        return ServiceResponse::ok($customersResource, $pages);
    }
}

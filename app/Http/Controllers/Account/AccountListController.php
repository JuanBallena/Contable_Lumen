<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Resources\AccountResource;
use App\JsonApi\ServiceResponse;
use App\Models\Account;

class AccountListController extends Controller
{
    public function toList()
    {
        $accounts = Account::applyFilters()->applySorts()->jsonPaginate();

        $accountsResource = AccountResource::collection($accounts);
        $pages = count($accountsResource) > 0 ? $accountsResource->lastPage() : 0;

        return ServiceResponse::ok($accountsResource, $pages);
    }
}

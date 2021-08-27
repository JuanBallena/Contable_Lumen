<?php

namespace App\Http\Controllers\MainAccount;

use App\Http\Controllers\Controller;
use App\Http\Resources\MainAccountResource;
use App\JsonApi\ServiceResponse;
use App\Models\MainAccount;

class MainAccountListController extends Controller
{
    public function toList()
    {
        $mainAccounts = MainAccount::all();

        $mainAccountsResource = MainAccountResource::collection($mainAccounts);
        $pages = count($mainAccountsResource) > 0 ? 1 : 0;

        return ServiceResponse::ok($mainAccountsResource, $pages);
    }
}

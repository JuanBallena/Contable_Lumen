<?php

namespace App\Http\Controllers\Month;

use App\Http\Controllers\Controller;
use App\JsonApi\ServiceResponse;
use App\Models\Month;

class MonthListController extends Controller
{
    public function toList()
    {
        $months = Month::all();
        $pages = count($months) > 0 ? 1 : 0;

        return ServiceResponse::ok($months, $pages);
    }
}

<?php

namespace App\Http\Controllers\AccountGroup;

use App\Http\Controllers\Controller;
use App\Http\Controllers\OperationType\OperationTypeCalculatorController;
use App\JsonApi\ServiceResponse;
use App\Models\MainAccount;
use Illuminate\Http\Request;

class AccountGroupCalculatorController extends Controller
{
    public function toCalculate(Request $request)
    {
        $idAccount = $request->idAccount;
        $amount = $request->amount;

        $mainAccount = MainAccount::firstWhere('idAccount', $idAccount);

        $accountsGroup = [];

        foreach ($mainAccount->accountsGroup as $index => $accountGroup) 
        {     
            $accountsGroup[$index] = [

                'idAccount'       => $accountGroup->account->idAccount,
                'number'          => $accountGroup->account->number,
                'description'     => $accountGroup->account->description,
                'idAmountType'    => $accountGroup->amountType->idParameter,
                'amountType'      => $accountGroup->amountType->description,
                'idOperationType' => $accountGroup->account->operationType->idOperationType,
                'amount'          => 
                    OperationTypeCalculatorController::calculate(
                        $amount, 
                        $accountGroup->account->operationType->idOperationType
                    )
            ];
        }

        return ServiceResponse::ok($accountsGroup, 0);
    }
}



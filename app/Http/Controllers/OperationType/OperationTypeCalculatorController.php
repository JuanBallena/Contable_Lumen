<?php

namespace App\Http\Controllers\OperationType;

use App\Http\Controllers\Controller;

class OperationTypeCalculatorController extends Controller
{
    const AMOUNT_WITH_IGV = 1;
    const AMOUNT_WITHOUT_IGV = 2;
    const CUSTOMUZABLE_AMOUNT = 3;
    const IGV_AMOUNT = 4;

    public static function calculate($amount, $idOperationType)
    {
        $igv = 0.18;
        $amountWithoutIgv = $amount/1.18;

        switch ($idOperationType) 
        {
            case self::AMOUNT_WITH_IGV:
                return round($amount, 2);
                break;

            case self::AMOUNT_WITHOUT_IGV:
                return round($amountWithoutIgv, 2);
                break;

            case self::CUSTOMUZABLE_AMOUNT:
                return 0;
                break;

            case self::IGV_AMOUNT:
                return round($amount - $amountWithoutIgv, 2);
                break;

            default:
                return 0;
        };
    }
}

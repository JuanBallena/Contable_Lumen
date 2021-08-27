<?php

namespace App\Http\Controllers\RecordAccount;

use App\Http\Controllers\Controller;
use App\Models\RecordAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RecordAccountSaveController extends Controller
{
    public function validateCreateRequest($values)
    {
        return Validator::make($values, $this->rulesToCreate(), $this->messages());
    }

    public function createRecordAccount(Request $request, $idRecord)
    {
        $recordAccount = new RecordAccount();
        $recordAccount->idRecord        = $idRecord;
        $recordAccount->idAccount       = $request->idAccount;
        $recordAccount->id002AmountType = $request->idAmountType ;
        $recordAccount->amount          = $request->amount;
        $recordAccount->save();

        return $recordAccount;
    }

    private function rules()
    {
        return [
            'idAccount'    => 'required|numeric|min:1',
            'idAmountType' => 'required|numeric|min:1',
            'amount'       => 'required'        
        ];
    }

    private function rulesToCreate()
    {
        return $this->rules();
    }

    private function messages()
    {
        return [
            'idAccount.required'    => 'Cuenta es requerido',
            'idAccount.numeric'     => 'Cuenta debe ser un número',
            'idAccount.min'         => 'Cuenta debe ser mayor a cero',
            'idAmountType.required' => 'Tipo de monto es requerido',
            'idAmountType.numeric'  => 'Tipo de monto debe ser un número',
            'idAmountType.min'      => 'Tipo de monto debe ser mayor a cero',
            'amount.required'       => 'Monto es requerido'
        ];
    }
}

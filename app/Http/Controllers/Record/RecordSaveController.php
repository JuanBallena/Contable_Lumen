<?php

namespace App\Http\Controllers\Record;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RecordAccount\RecordAccountSaveController;
use App\Http\Resources\RecordResource;
use App\JsonApi\ServiceResponse;
use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RecordSaveController extends Controller
{
    public function toCreate(Request $request)
    {
        $validator = $this->validateCreateRequest($request->all());

        if ($validator->fails())
        {
            return ServiceResponse::badRequest($validator->errors());
        }

        $recordAccountSaveController = new RecordAccountSaveController();
        $validatorAccountsFails = [];
        $validatorAccountsErrors = [];

        for ($i = 0; $i < count($request->accounts); $i++) 
        {     
            $validatorAccount = 
                $recordAccountSaveController->validateCreateRequest($request->accounts[$i]);
            $validatorAccountsFails[$i] = $validatorAccount->fails();
            $validatorAccountsErrors[$i] = $validatorAccount->errors();
        }

        for ($i = 0; $i < count($validatorAccountsFails); $i++)
        {    
            if ($validatorAccountsFails[$i])
            {
                return ServiceResponse::badRequest($validatorAccountsErrors);
            }
        }
        
        $recordCreated = $this->createRecord($request);

        if ($recordCreated)
        {
            $this->createRecordAccounts($request->accounts, $recordCreated->idRecord);
        }

        return ServiceResponse::created(RecordResource::make($recordCreated));
    }

    public function toUpdate(Request $request, $id)
    {
        $validator = $this->validateUpdateRequest($request->all());

        if ($validator->fails())
        {
            return ServiceResponse::badRequest($validator->errors());
        }

        $recordUpdater = $this->updateRecord($request, $id);

        return ServiceResponse::created(RecordResource::make($recordUpdater));
    }

    public function validateCreateRequest($values)
    {
        return Validator::make($values, $this->rulesToCreate(), $this->messages());
    }

    public function validateUpdateRequest($values)
    {
        return Validator::make($values, $this->rulesToUpdate(), $this->messages());
    }

    public function createRecord(Request $request)
    {
        $record = new Record();
        $record->idMonth          = $request->idMonth;
        $record->idCustomer       = $request->idCustomer;
        $record->idMoneyType      = $request->idMoneyType;
        $record->idVoucherType    = $request->idVoucherType;
        $record->id001RecordType  = $request->idRecordType;
        $record->exchangeType     = $request->exchangeType;
        $record->voucherDate      = $request->voucherDate;
        $record->voucherNumber    = $request->voucherNumber;
        $record->voucherAmount    = $request->voucherAmount;
        $record->gloss            = $request->gloss;
        $record->createdAt        = date('Y-m-d H:i:s');
        $record->save();

        return $record;
    }

    public function createRecordAccounts($accounts, $idRecord)
    {
        $recordAccountSaveController = new RecordAccountSaveController();

        for ($i=0; $i < count($accounts); $i++) 
        {     
            $recordAccountSaveController
                ->createRecordAccount(new Request($accounts[$i]), $idRecord);
        }
    }

    public function updateRecord(Request $request, $id)
    {
        $record = Record::findOrFail($id);
        $record->idMonth       = $request->idMonth;
        $record->idCustomer    = $request->idCustomer;
        $record->idMoneyType   = $request->idMoneyType;
        $record->idVoucherType = $request->idVoucherType;
        $record->exchangeType  = $request->exchangeType;
        $record->voucherDate   = $request->voucherDate;
        $record->voucherNumber = $request->voucherNumber;
        $record->voucherAmount = $request->voucherAmount;
        $record->gloss         = $request->gloss;
        $record->updatedAt     = date('Y-m-d H:i:s');
        $record->save();

        return $record;
    }

    private function rules()
    {
        return [
            'idMonth'       => 'required|numeric|min:1',
            'idCustomer'    => 'required|numeric|min:1',
            'idMoneyType'   => 'required|numeric|min:1',
            'idVoucherType' => 'required|numeric|min:1',
            'idRecordType'  => 'required|numeric|min:1',
            'exchangeType'  => 'required|numeric',
            'voucherDate'   => 'required',
            'voucherNumber' => 'required|max:20',
            'voucherAmount' => 'required',
            'gloss'         => 'required',
        ];
    }

    private function rulesToCreate()
    {
        return $this->rules();
    }

    private function rulesToUpdate()
    {
        return $this->rules();
    }

    private function messages()
    {
        return [
            'idMonth.required'       => 'Mes es requerido',
            'idMonth.numeric'        => 'Mes debe ser un número',
            'idMonth.min'            => 'Mes es requerido',
            'idCustomer.required'    => 'Cliente es requerido',
            'idCustomer.numeric'     => 'Cliente debe ser un número',
            'idCustomer.min'         => 'Cliente es requerido',
            'idMoneyType.required'   => 'Moneda es requerido',
            'idMoneyType.numeric'    => 'Moneda debe ser un número',
            'idMoneyType.min'        => 'Moneda es requerido',
            'idVoucherType.required' => 'Tipo de comprobante es requerido',
            'idVoucherType.numeric'  => 'Tipo de comprobante debe ser un número',
            'idVoucherType.min'      => 'Tipo de comprobante es requerido',
            'idRecordType.required'  => 'Tipo de registro es requerido',
            'idRecordType.numeric'   => 'Tipo de registro debe ser un número',
            'idRecordType.min'       => 'Tipo de registro es requerido',
            'exchangeType.required'  => 'Tipo de cambio es requerido',
            'exchangeType.numeric'   => 'Tipo de cambio debe ser un número',
            'voucherDate.required'   => 'Fecha de comprobante es requerido',
            'voucherNumber.required' => 'Número de comprobante es requerido',
            'voucherNumber.max'      => 'Máximo :max caracteres',
            'voucherAmount.required' => 'Monto de comprobante es requerido',
            'gloss.required'         => 'Glosa es requerido',
        ];
    }
}

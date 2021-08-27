<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Resources\AccountResource;
use App\JsonApi\ServiceResponse;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountSaveController extends Controller
{
    public function toCreate(Request $request)
    {
        $validator = $this->validateCreateRequest($request->all());

        if ($validator->fails())
        {
            return ServiceResponse::badRequest($validator->errors());
        }
        
        $accountCreated = $this->createAccount($request);

        return ServiceResponse::created(AccountResource::make($accountCreated));
    }

    public function toUpdate(Request $request, $id)
    {
        $validator = $this->validateUpdateRequest($request->all());

        if ($validator->fails())
        {
            return ServiceResponse::badRequest($validator->errors());
        }

        $accountUpdated = $this->updateAccount($request, $id);

        return ServiceResponse::created(AccountResource::make($accountUpdated));
    }

    public function validateCreateRequest($values)
    {
        return Validator::make($values, $this->rulesToCreate(), $this->messages());
    }

    public function validateUpdateRequest($values)
    {
        return Validator::make($values, $this->rulesToUpdate(), $this->messages());
    }

    public function createAccount(Request $request)
    {
        $account = new Account();
        $account->idAccountType = $request->idAccountType;
        $account->number        = $request->number;
        $account->description   = $request->description;
        $account->save();

        return $account;
    }

    public function updateAccount(Request $request, $idAccount)
    {
        $account = Account::findOrFail($idAccount);
        $account->idAccountType = $request->idAccountType;
        $account->number        = $request->number;
        $account->description   = $request->description;
        $account->save();

        return $account;
    }

    private function rules()
    {
        return [
            'idAccountType' => 'required|numeric|min:1',
            'number'        => 'required|max:10',
            'description'   => 'required|max:200'
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
            'idAccountType.required' => 'Tipo de cuenta es requerido',
            'idAccountType.numeric'  => 'Tipo de cuenta debe ser un número',
            'idAccountType.min'      => 'Tipo de cuenta debe ser mayor a cero',
            'number.required'        => 'Número de cuenta es requerido',
            'number.max'             => 'Máximo :max caracteres',
            'description.required'   => 'Descripción de cuenta es requerido',
            'description.max'        => 'Máximo :max caracteres'
        ];
    }
}

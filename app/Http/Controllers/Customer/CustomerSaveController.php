<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\JsonApi\ServiceResponse;
use App\Models\Customer;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerSaveController extends Controller
{
    public function toCreate(Request $request)
    {
        $validator = $this->validateCreateRequest($request->all());

        if ($validator->fails())
        {
            return ServiceResponse::badRequest($validator->errors());
        }
        
        $customerCreated = $this->createCustomer($request);

        return ServiceResponse::created(CustomerResource::make($customerCreated));
    }

    public function toUpdate(Request $request, $id)
    {
        $validator = $this->validateUpdateRequest($request->all(), $id);

        if ($validator->fails())
        {
            return ServiceResponse::badRequest($validator->errors());
        }

        $customerUpdater = $this->updateCustomer($request, $id);

        return ServiceResponse::created(CustomerResource::make($customerUpdater));
    }

    public function validateCreateRequest($values)
    {
        return Validator::make($values, $this->rulesToCreate($values), $this->messages());
    }

    public function validateUpdateRequest($values, $idCustomer)
    {
        return Validator::make($values, $this->rulesToUpdate($idCustomer, $values), $this->messages());
    }

    public function createCustomer(Request $request)
    {
        $customer = new Customer();
        $customer->idDocumentType = $request->idDocumentType;
        $customer->document       = $request->document;
        $customer->name           = $request->name;
        $customer->save();

        return $customer;
    }

    public function updateCustomer(Request $request, $idCustomer)
    {
        $customer = Customer::findOrFail($idCustomer);
        $customer->idDocumentType = $request->idDocumentType;
        $customer->document       = $request->document;
        $customer->name           = $request->name;
        $customer->save();

        return $customer;
    }

    private function validateNumberDocumentCharacters($value, $fail, $values) 
    {
        if ($values['idDocumentType'] == DocumentType::DNI) {

            if ($value != 8) {
                $fail('Debe ingresar 8 caracteres');
            }
        }
        if ($values['idDocumentType'] == DocumentType::RUC) {
            if ($value != 11) {
                $fail('Debe ingresar 11 caracteres');
            }
        }
    }

    private function rulesToCreate($values)
    {
        return [
            'idDocumentType' => 'required|numeric|min:1',
            'name'           => 'required|max:100',
            'document'       => ['required', 'unique:customers',
                function($attribute, $value, $fail) use ($values) {
                    $this->validateNumberDocumentCharacters($value, $fail, $values);
                }
            ],
        ];
    }

    private function rulesToUpdate($idCustomer, $values)
    {
        return [
            'idDocumentType' => 'required|numeric|min:1',
            'name'           => 'required|max:100',
            'document'       => ['required','unique:customers,document,'.$idCustomer.',idCustomer',
                function($attribute, $value, $fail) use ($values) {
                    $this->validateNumberDocumentCharacters($value, $fail, $values);
                }
            ],
        ];
    }

    private function messages()
    {
        return [
            'idDocumentType.required' => 'Tipo de documento es requerido',
            'idDocumentType.numeric'  => 'Tipo de documento debe ser un número',
            'idDocumentType.min'      => 'Tipo de documento es requerido',
            'document.required'       => 'Documento es requerido',
            'document.unique'         => 'Documento existente, ingrese otro número',
            'name.required'           => 'Nombre es requerido',
            'name.max'                => 'Máximo :max caracteres'
        ];
    }
}

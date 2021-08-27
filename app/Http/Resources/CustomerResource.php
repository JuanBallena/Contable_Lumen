<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'idCustomer'     => $this->idCustomer,
            'idDocumentType' => $this->documentType->idDocumentType,
            'documentType'   => $this->documentType->abbreviation,
            'document'       => $this->document,
            'name'           => $this->name
        ];
    }
}

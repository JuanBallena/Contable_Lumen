<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DocumentTypeResource extends JsonResource
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
            'idDocumentType' => $this->idDocumentType,
            'number'         => $this->number,
            'description'    => $this->description,
            'abbreviation'   => $this->abbreviation
        ];
    }
}

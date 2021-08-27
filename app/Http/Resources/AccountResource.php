<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
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
            'idAccount'     => $this->idAccount,
            'idAccountType' => $this->accountType->idAccountType,
            'accountType'   => $this->accountType->description,
            'number'        => $this->number,
            'description'   => $this->description
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecordAccountResource extends JsonResource
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
            'idRecordAccount' => $this->idRecordAccount,
            'idAccount'       => $this->account->idAccount,
            'accountNumber'   => $this->account->number,
            'account'         => $this->account->description,
            'idAmountType'    => $this->amountType->idParameter,
            'amountType'      => $this->amountType->description,
            'amount'          => $this->amount
        ];
    }
}

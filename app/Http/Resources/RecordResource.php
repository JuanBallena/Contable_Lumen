<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RecordResource extends JsonResource
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
            'idRecord'       => $this->idRecord,
            'idMonth'        => $this->month->idMonth,
            'month'          => $this->month->name,
            'idCustomer'     => $this->customer->idCustomer,
            'customer'       => $this->customer->name,
            'idDocumentType' => $this->customer->documentType->idDocumentType,
            'documentType'   => $this->customer->documentType->description,
            'document'       => $this->customer->document,
            'idMoneyType'    => $this->moneyType->idMoneyType,
            'money'          => $this->moneyType->description,
            'idVoucherType'  => $this->voucherType->idVoucherType,
            'voucherType'    => $this->voucherType->description,
            'idRecordType'   => $this->recordType->idParameter,
            'recordType'     => $this->recordType->description,
            'exchangeType'   => $this->exchangeType,
            'voucherDate'    => $this->voucherDate->format('Y-m-d'),
            'voucherDateDMY' => $this->voucherDate->format('d-m-Y'),
            'voucherNumber'  => $this->voucherNumber,
            'voucherAmount'  => $this->voucherAmount,
            'gloss'          => $this->gloss,
            'createdAt'      => $this->createdAt->format('d-m-Y'),
            'accounts'       => RecordAccountResource::collection($this->accounts)
        ];
    }
}

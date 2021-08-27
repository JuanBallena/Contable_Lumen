<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MoneyTypeResource extends JsonResource
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
            'idMoneyType'  => $this->idMoneyType,
            'number'       => $this->number,
            'description'  => $this->description,
            'abbreviation' => $this->abbreviation
        ];
    }
}

<?php

namespace App\Http\ApiV1\Modules\Addresses\Resources;

use App\Domain\Customers\Models\Customer;
use App\Http\ApiV1\Support\Resources\BaseJsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @mixin \App\Domain\Addresses\Models\Address */
class AddressResource extends BaseJsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name_from_customer' => $this->name_from_customer,
            'city' => $this->city,
            'street_or_district' => $this->street_or_district,
            'house_number' => $this->house_number,
            'flat_number' => $this->flat_number,
            'customers' => CustomerResource::collection($this->whenLoaded('customers')),
        ];
    }
}

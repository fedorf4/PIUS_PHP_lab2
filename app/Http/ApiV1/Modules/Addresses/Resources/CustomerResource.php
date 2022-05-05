<?php

namespace App\Http\ApiV1\Modules\Addresses\Resources;

use App\Domain\Customers\Models\Customer;
use App\Http\ApiV1\Support\Resources\BaseJsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @mixin \App\Domain\Addresses\Models\Address */
class CustomerResource extends BaseJsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'surname' => $this->surname,
            'phone' => $this->phone,
            'email' => $this->email,
            'address_id' => $this->address_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

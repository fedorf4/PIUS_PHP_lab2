<?php

namespace App\Http\ApiV1\Modules\Addresses\Requests;

use App\Http\ApiV1\Support\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class PatchAddressRequest extends BaseFormRequest
{
    public function rules(): array
    {
        $id = (int) $this->route('addressId');
        return [
            'name_from_customer' => ['string'],
            'city' => ['string'],
            'street_or_district' => ['string'],
            'house_number' => ['integer'],
            'flat_number' => ['integer'],
        ];
    }
}

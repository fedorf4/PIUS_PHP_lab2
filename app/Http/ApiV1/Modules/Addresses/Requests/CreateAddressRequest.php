<?php

namespace App\Http\ApiV1\Modules\Addresses\Requests;

use App\Http\ApiV1\Support\Requests\BaseFormRequest;
use Illuminate\Validation\Rule;

class CreateAddressRequest extends BaseFormRequest
{
    public function rules(): array
    {
        $id = (int) $this->route('addressId');
        return [
            'name_from_customer' => ['required', 'string'],
            'city' => ['required', 'string'],
            'street_or_district' => ['required', 'string'],
            'house_number' => ['required', 'integer'],
            'flat_number' => ['required', 'integer'],
        ];
    }
}

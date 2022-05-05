<?php

namespace App\Http\ApiV1\Modules\Addresses\Requests;

use App\Http\ApiV1\Support\Requests\BaseFormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ReplaceAddressRequest extends BaseFormRequest
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

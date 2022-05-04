<?php

namespace App\Http\ApiV1\Modules\Addresses\Requests;

use App\Http\ApiV1\Support\Requests\BaseFormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

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

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        $response = response()->json([
            'code' => 'InvalidInputException',
            'message' => 'Invalid data send',
            'meta' => $errors->messages(),
        ], JsonResponse::HTTP_BAD_REQUEST);
        throw new HttpResponseException($response);
    }
}

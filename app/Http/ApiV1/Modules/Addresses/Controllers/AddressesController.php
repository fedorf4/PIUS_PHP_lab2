<?php

namespace App\Http\ApiV1\Modules\Addresses\Controllers;

use App\Domain\Addresses\Actions\CreateAddressAction;
use App\Domain\Addresses\Actions\DeleteAddressAction;
use App\Domain\Addresses\Actions\GetAddressAction;
use App\Domain\Addresses\Actions\PatchAddressAction;
use App\Domain\Addresses\Actions\ReplaceAddressAction;

use App\Http\ApiV1\Modules\Addresses\Requests\CreateAddressRequest;
use App\Http\ApiV1\Modules\Addresses\Requests\PatchAddressRequest;
use App\Http\ApiV1\Modules\Addresses\Requests\ReplaceAddressRequest;

use App\Http\ApiV1\Modules\Addresses\Resources\AddressResource;
use App\Http\ApiV1\Support\Resources\EmptyResource;
use Illuminate\Http\Request;

class AddressesController
{
    public function create(CreateAddressRequest $request, CreateAddressAction $action): AddressResource
    {
        return new AddressResource($action->execute($request->validated()));
    }

    public function patch(int $addressId, PatchAddressRequest $request, PatchAddressAction $action): AddressResource
    {
        return new AddressResource($action->execute($addressId, $request->validated()));
    }

    public function replace(int $addressId, ReplaceAddressRequest $request, ReplaceAddressAction $action): AddressResource
    {
        return new AddressResource($action->execute($addressId, $request->validated()));
    }

    public function delete(int $addressId, DeleteAddressAction $action): EmptyResource
    {
        $action->execute($addressId);
        return new EmptyResource();
    }

    public function get(int $addressId, GetAddressAction $action, Request $request): AddressResource
    {
        return new AddressResource($action->execute($addressId, $request));
    }
}

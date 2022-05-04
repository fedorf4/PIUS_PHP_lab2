<?php

namespace App\Domain\Addresses\Actions;

use App\Domain\Addresses\Models\Address;

class DeleteAddressAction
{
    public function execute(int $addressId): void
    {
        Address::findOrFail($addressId)->delete();
    }
}

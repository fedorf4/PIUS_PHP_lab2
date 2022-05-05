<?php

namespace App\Domain\Addresses\Actions;

use App\Domain\Addresses\Models\Address;

class PatchAddressAction
{
    public function execute(int $addressId, array $fields): Address
    {
        $address = Address::findOrFail($addressId);
        $address->update($fields);
        return $address;
    }
}

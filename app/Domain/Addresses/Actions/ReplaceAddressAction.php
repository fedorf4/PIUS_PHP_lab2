<?php

namespace App\Domain\Addresses\Actions;

use App\Domain\Addresses\Models\Address;

class ReplaceAddressAction
{
    public function execute(int $addressId, array $fields): Address
    {
        $address = Address::findOrFail($addressId);
        $address->update($fields);
        return $address;
    }
}

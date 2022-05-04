<?php

namespace App\Domain\Addresses\Actions;

use App\Domain\Addresses\Models\Address;

class CreateAddressAction
{
    public function execute(array $fields): Address
    {
        return Address::create($fields);
    }
}

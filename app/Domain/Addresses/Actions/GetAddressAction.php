<?php

namespace App\Domain\Addresses\Actions;

use App\Domain\Addresses\Models\Address;
use Illuminate\Http\Request;

class GetAddressAction
{
    public function execute(int $addressId, Request $request): Address
    {
        if ($request->get('include') === 'customers')
            return Address::with('customers')->findOrFail($addressId);
        return Address::findOrFail($addressId);
    }
}

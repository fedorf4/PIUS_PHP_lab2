<?php

namespace App\Domain\Addresses\Models;

use App\Domain\Addresses\Models\Factories\AddressFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Domain\Customers\Models\Customer;

class Address extends Model
{
    use HasFactory;

    public static function factory(): AddressFactory
    {
        return AddressFactory::new();
    }

    public $timestamps = false;

    protected $fillable = [
        'name_from_customer',
        'city',
        'street_or_district',
        'house_number',
        'flat_number',
    ];

    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class);
    }
}

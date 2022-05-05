<?php

namespace App\Domain\Customers\Models;

use App\Domain\Customers\Models\Factories\CustomerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    use HasFactory;

    public static function factory(): CustomerFactory
    {
        return CustomerFactory::new();
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
}

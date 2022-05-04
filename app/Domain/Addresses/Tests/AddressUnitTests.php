<?php

namespace App\Domain\Addresses\Tests;

use App\Domain\Addresses\Models\Address;
use App\Domain\Customers\Models\Customer;
use Tests\TestCase;

use function Pest\Laravel\deleteJson;
use function Pest\Laravel\getJson;
use function Pest\Laravel\patchJson;
use function Pest\Laravel\postJson;
use function Pest\Laravel\putJson;

uses(TestCase::class);
uses()->group('unit');

// POST
test('post: address has created', function () {
    $address = Address::factory()->raw();
    $expected = [
        'data' => [
            'name_from_customer' => $address['name_from_customer'],
            'city' => $address['city'],
            'street_or_district' => $address['street_or_district'],
            'house_number' => $address['house_number'],
            'flat_number' => $address['flat_number'],
        ]
    ];
    postJson("/api/v1/addresses", $address)
        ->assertStatus(201)
        ->assertJson($expected);
});

test('post: address not created due to the absence of a required field', function () {
    $address = Address::factory()->raw();
    unset($address['city']);
    $expected = [
        'data' => null
    ];
    postJson("/api/v1/addresses", $address)
        ->assertStatus(400)
        ->assertJson($expected);
});

test('post: address not created due to the wrong type of a field', function () {
    $address = Address::factory()->raw();
    $address['flat_number'] = '10qwe';
    $expected = [
        'data' => null
    ];
    postJson("/api/v1/addresses", $address)
        ->assertStatus(400)
        ->assertJson($expected);
});

// DELETE
test('delete: address by id deleted', function () {
    $address = Address::factory()->create();
    $expected = [
        'data' => null
    ];
    deleteJson("/api/v1/addresses/{$address->id}")
        ->assertStatus(200)
        ->assertJson($expected);
});

test('delete: address with non-existent id not found', function () {
    $address = Address::factory()->create();
    $id = $address->id + 10;
    $expected = [
        'data' => null
    ];
    deleteJson("/api/v1/addresses/{$id}")
        ->assertStatus(404)
        ->assertJson($expected);
});

// GET
test('get: single address recieved by id', function () {
    $address = Address::factory()->create();
    $expected = [
        'data' => [
            'id' => $address['id'],
            'name_from_customer' => $address['name_from_customer'],
            'city' => $address['city'],
            'street_or_district' => $address['street_or_district'],
            'house_number' => $address['house_number'],
            'flat_number' => $address['flat_number'],
        ]
    ];
    getJson("/api/v1/addresses/{$address->id}")
        ->assertStatus(200)
        ->assertJson($expected);
});

test('get: address with customers recieved by id', function () {

    $address = Address::factory()->create();
    $customer = Customer::factory()->create(['address_id' => $address->id]);
    $expected = [
        'data' => [
            'id' => $address['id'],
            'name_from_customer' => $address['name_from_customer'],
            'city' => $address['city'],
            'street_or_district' => $address['street_or_district'],
            'house_number' => $address->house_number,
            'flat_number' => $address['flat_number'],
            'customers' =>
            [
                [
                    'id' => $customer->id,
                    'name' => $customer['name'],
                    'surname' => $customer['surname'],
                    'phone' => $customer['phone'],
                    'email' => $customer['email'],
                    'address_id' => $address['id'],
                ],
            ],
        ]
    ];
    getJson("/api/v1/addresses/{$address->id}?include=customers")
        ->assertStatus(200)
        ->assertJson($expected);
});

test('get: address with non-existent id not found', function () {
    $address = Address::factory()->create();
    $idNonExisting = $address->id + 10;

    $expected = [
        'data' => null
    ];
    getJson("/api/v1/addresses/{$idNonExisting}")
        ->assertStatus(404)
        ->assertJson($expected);
});

// PATCH
test('patch: address has updated', function () {
    $address = Address::factory()->create();
    $fields = Address::factory()->raw();
    unset($fields['city']);
    unset($fields['flat_number']);
    $expected = [
        'data' => [
            'id' => $address['id'],
            'name_from_customer' => $fields['name_from_customer'],
            'city' => $address['city'],
            'street_or_district' => $fields['street_or_district'],
            'house_number' => $fields['house_number'],
            'flat_number' => $address['flat_number'],
        ]
    ];
    patchJson("/api/v1/addresses/{$address->id}", $fields)
        ->assertStatus(200)
        ->assertJson($expected);
});

test('patch: address with non existing id has no been updated', function () {
    $address = Address::factory()->create();
    $idNonExisting = $address->id + 10;
    $fields = Address::factory()->raw();
    $expected = [
        'data' => null
    ];
    patchJson("/api/v1/addresses/{$idNonExisting}", $fields)
        ->assertStatus(404)
        ->assertJson($expected);
});

// PUT
test('put: address has full updated', function () {
    $address = Address::factory()->create();
    $fields = Address::factory()->raw();
    $expected = [
        'data' => [
            'id' => $address['id'],
            'name_from_customer' => $fields['name_from_customer'],
            'city' => $fields['city'],
            'street_or_district' => $fields['street_or_district'],
            'house_number' => $fields['house_number'],
            'flat_number' => $fields['flat_number'],
        ]
    ];
    putJson("/api/v1/addresses/{$address->id}", $fields)
        ->assertStatus(200)
        ->assertJson($expected);
});

test('put: address has no updated without required fields', function () {
    $address = Address::factory()->create();
    $fields = Address::factory()->raw();
    unset($fields['city']);
    $expected = [
        'data' => null
    ];
    putJson("/api/v1/addresses/{$address->id}", $fields)
        ->assertStatus(400)
        ->assertJson($expected);
});

test('put: address with non existing id not founded', function () {
    $address = Address::factory()->create();
    $idNonExisting = $address->id + 10;
    $fields = Address::factory()->raw();
    $expected = [
        'data' => null
    ];
    patchJson("/api/v1/addresses/{$idNonExisting}", $fields)
        ->assertStatus(404)
        ->assertJson($expected);
});

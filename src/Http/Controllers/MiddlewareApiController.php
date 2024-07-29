<?php

namespace Robodocxs\LaravelErpMiddleware\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Robodocxs\LaravelErpMiddleware\DTOs\ProductDTO;
use Robodocxs\LaravelErpMiddleware\DTOs\AccountDTO;
use Robodocxs\LaravelErpMiddleware\DTOs\ContactDTO;
use Robodocxs\LaravelErpMiddleware\DTOs\AddressDTO;
use Robodocxs\LaravelErpMiddleware\DTOs\CustomOrderCodeDTO;
use Robodocxs\LaravelErpMiddleware\DTOs\PARequestDTO;
use Robodocxs\LaravelErpMiddleware\DTOs\PAResponseDTO;

class MiddlewareApiController extends Controller
{

    public function listProducts(Request $request)
    {
        $products = Collection::make([
            ProductDTO::from([
                'id' => '1',
                'product_code' => 'ABC123',
                'product_code_2' => 'XYZ-001',
                'name' => 'Fake Product 1',
                'description' => 'This is a fake product for testing',
                'base_unit_id' => 1,
                'ean' => '1234567890123'
            ]),
            ProductDTO::from([
                'id' => '2',
                'product_code' => 'DEF456',
                'product_code_2' => 'XYZ-002',
                'name' => 'Fake Product 2',
                'description' => 'This is another fake product for testing',
                'base_unit_id' => 2,
                'ean' => '9876543210987'
            ])
        ])->when($request->input('search'), function ($collection, $search) {
            return $collection->filter(fn($product) => str_contains(strtolower($product->name), strtolower($search)) ||
                str_contains(strtolower($product->product_code), strtolower($search))
            );
        })->values();

        return response()->json($products);
    }

    public function listAccounts(Request $request)
    {
        $accounts = Collection::make([
            AccountDTO::from([
                'erp_id' => 'ERP001',
                'vat_id' => 'VAT001',
                'name' => 'Fake Company 1',
                'address' => ['street' => 'Main St', 'house_number' => '1', 'zip' => '12345', 'city' => 'Faketown'],
                'delivery_addresses' => [],
                'invoice_addresses' => []
            ]),
            AccountDTO::from([
                'erp_id' => 'ERP002',
                'vat_id' => 'VAT002',
                'name' => 'Fake Company 2',
                'address' => ['street' => 'Second St', 'house_number' => '2', 'zip' => '67890', 'city' => 'Mockville'],
                'delivery_addresses' => [],
                'invoice_addresses' => []
            ])
        ])->when($request->input('name'), function ($collection, $name) {
            return $collection->filter(fn($account) => str_contains(strtolower($account->name), strtolower($name))
            );
        })->when($request->input('vat_id'), function ($collection, $vatId) {
            return $collection->filter(fn($account) => str_contains(strtolower($account->vat_id), strtolower($vatId))
            );
        })->values();

        return response()->json($accounts);
    }

    public function listAccountContacts($account_id)
    {
        $contacts = Collection::make([
            ContactDTO::from([
                'id' => '1',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john.doe@fakecompany.com',
                'phone' => '1234567890'
            ]),
            ContactDTO::from([
                'id' => '2',
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'email' => 'jane.smith@fakecompany.com',
                'phone' => '0987654321'
            ])
        ])->values();

        return response()->json($contacts);
    }

    public function listAccountAddresses($account_id)
    {
        $addresses = Collection::make([
            AddressDTO::from([
                'id' => '1',
                'name' => 'Headquarters',
                'street' => 'Main St',
                'house_number' => '123',
                'zip' => '12345',
                'city' => 'Faketown',
                'country_code' => 'FC',
                'type' => 'billing'
            ]),
            AddressDTO::from([
                'id' => '2',
                'name' => 'Warehouse',
                'street' => 'Storage Lane',
                'house_number' => '456',
                'zip' => '67890',
                'city' => 'Mockville',
                'country_code' => 'FC',
                'type' => 'delivery'
            ])
        ])->values();

        return response()->json($addresses);
    }

    public function listAccountCustomProducts($account_id)
    {
        $customProducts = Collection::make([
            CustomOrderCodeDTO::from([
                'product_code' => 'ABC123',
                'custom_product_code' => 'CUST-001'
            ]),
            CustomOrderCodeDTO::from([
                'product_code' => 'DEF456',
                'custom_product_code' => 'CUST-002'
            ])
        ])->values();

        return response()->json($customProducts);
    }

    public function checkPriceAndAvailability(Request $request)
    {
        $paRequests = PARequestDTO::collection($request->all());

        // Simulate price and availability check
        $paResponses = $paRequests->map(function (PARequestDTO $paRequest) {
            // In a real-world scenario, you would perform actual price and availability checks here
            $unitPrice = rand(10, 100) + (rand(0, 99) / 100); // Random price between 10.00 and 100.99

            return new PAResponseDTO(
                id: $paRequest->id,
                product_code: $paRequest->product_code,
                quantity: $paRequest->quantity,
                unit_price: $unitPrice
            );
        })->values();

        return response()->json($paResponses);
    }

    public function ping()
    {
        return response()->json(['msg' => 'Pong.']);
    }
}

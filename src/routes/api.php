<?php

use Illuminate\Support\Facades\Route;
use Robodocxs\LaravelErpMiddleware\Http\Controllers\MiddlewareApiController;
Route::middleware('auth.basic.once')->prefix('api')->group(function () {

    Route::get('/products', [MiddlewareApiController::class, 'listProducts'])
        ->name('products.index');

    Route::get('/accounts', [MiddlewareApiController::class, 'listAccounts'])
        ->name('accounts.index');

    Route::get('/accounts/{account_id}/erp-documents', [MiddlewareApiController::class, 'listErpDocuments'])
        ->name('accounts.erp-documents');

    Route::get('/accounts/{account_id}/contacts', [MiddlewareApiController::class, 'listAccountContacts'])
        ->name('accounts.contacts');

    Route::get('/accounts/{account_id}/addresses', [MiddlewareApiController::class, 'listAccountAddresses'])
        ->name('accounts.addresses');

    Route::get('/accounts/{account_id}/products', [MiddlewareApiController::class, 'listAccountCustomProducts'])
        ->name('accounts.products');

    Route::post('/products/price-and-availability', [MiddlewareApiController::class, 'checkPriceAndAvailability'])
        ->name('products.price-availability');

    Route::get('/ping', [MiddlewareApiController::class, 'ping'])
        ->name('ping');
});

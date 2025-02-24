# Laravel ERP Middleware

This package provides a middleware for ERP integration in Laravel applications, including basic DTOs, custom middleware for one-time basic authentication, custom exception handling, and additional capabilities for SFTP file system operations and CSV handling.

## Installation

Only if you want to start from a new laravel project:

```bash
php artisan laravel new robodocxs-middleware-something
```

Install the package via composer:

```bash
composer require robodocxs/laravel-erp-middleware
```

After installation, you should publish the configuration file:

```bash
php artisan vendor:publish --provider="Robodocxs\LaravelErpMiddleware\LaravelErpMiddlewareServiceProvider" --tag="config"
```

This will publish the `robodocxs-erp-middleware.php` configuration file to your config directory.

Then, install the api:

```bash
php artisan api:install
```

Use this example routes file:

```
Route::middleware('auth.basic.once')->group(function () {

    Route::get('/products', [LaravelErpMiddlewareController::class, 'listProducts'])
        ->name('products.index');

    Route::get('/accounts', [LaravelErpMiddlewareController::class, 'listAccounts'])
        ->name('accounts.index');

    Route::get('/accounts/{account_id}/contacts', [LaravelErpMiddlewareController::class, 'listAccountContacts'])
        ->name('accounts.contacts');

    Route::get('/accounts/{account_id}/addresses', [LaravelErpMiddlewareController::class, 'listAccountAddresses'])
        ->name('accounts.addresses');

    Route::get('/accounts/{account_id}/products', [LaravelErpMiddlewareController::class, 'listAccountCustomProducts'])
        ->name('accounts.products');

    Route::post('/products/price-and-availability', [LaravelErpMiddlewareController::class, 'checkPriceAndAvailability'])
        ->name('products.price-availability');

    Route::get('/ping', [LaravelErpMiddlewareController::class, 'ping'])
        ->name('ping');
});
```

To publish the built-in Controller as a starting point, use this command:

```bash
laravel-erp-middleware:publish-api-controller
```

## Configuration

If you need SFTP access, add the following disk to `config/filesystems.php` file directly:

```
'fileshare' => [
    'driver' => 'sftp',
    'host' => env('SFTP_HOST'),
    'username' => env('SFTP_USERNAME'),
    'password' => env('SFTP_PASSWORD'),
    'privateKey' => env('SFTP_PRIVATE_KEY'),
    'passphrase' => env('SFTP_PASSPHRASE'),
    'root' => env('SFTP_ROOT'),
    'visibility' => 'private', // `private` = 0600, `public` = 0644
    'directory_visibility' => 'private', // `private` = 0700, `public` = 0755
    // 'hostFingerprint' => env('SFTP_HOST_FINGERPRINT'),
    // 'maxTries' => 4,
    // 'passphrase' => env('SFTP_PASSPHRASE'),
    // 'port' => env('SFTP_PORT', 22),
    // 'root' => env('SFTP_ROOT', ''),
    // 'timeout' => 30,
    // 'useAgent' => true,
    // Setting for the environment
]
```

Then add the following keys to your env to use the disk:

```
SFTP_HOST=your_sftp_host
SFTP_USERNAME=your_username
SFTP_PASSWORD=your_password
SFTP_PRIVATE_KEY=path_to_your_private_key
SFTP_PASSPHRASE=your_passphrase
SFTP_ROOT=/home/someuser
```

## Features

- Basic DTOs using spatie/laravel-data
- Custom middleware for one-time basic authentication
- Custom exception handling for API-friendly responses
- SFTP file system operations using league/flysystem-sftp-v3
- CSV handling capabilities using league/csv

## API Routes and Middleware Controller

This package provides pre-defined API routes and a middleware controller to handle them. All routes are protected by the `AuthenticateOnceWithBasicAuth` middleware, which implements one-time basic authentication.

The following routes are available:

### 1. List Products
- **Endpoint:** `GET /api/products`
- **Query Parameters:** `search` (optional)
- **Response:** Collection of ProductDTOs

### 2. List Accounts
- **Endpoint:** `GET /api/accounts`
- **Query Parameters:** `name`, `vat_id` (both optional)
- **Response:** Collection of AccountDTOs

### 3. List Account Contacts
- **Endpoint:** `GET /api/accounts/{account_id}/contacts`
- **Response:** Collection of ContactDTOs

### 4. List Account Addresses
- **Endpoint:** `GET /api/accounts/{account_id}/addresses`
- **Response:** Collection of AddressDTOs

### 5. List Account Custom Products
- **Endpoint:** `GET /api/accounts/{account_id}/products`
- **Response:** Collection of CustomOrderCodeDTOs

### 6. Check Price and Availability
- **Endpoint:** `POST /api/products/price-and-availability`
- **Request Body:** Array of PARequestDTO objects
- **Response:** Array of PAResponseDTO objects

All these routes require authentication. The `AuthenticateOnceWithBasicAuth` middleware will prompt for credentials on the first request and then allow subsequent requests without re-authentication for a limited time.

## Usage

### DTOs

This package provides several Data Transfer Objects (DTOs) for handling various data structures:

#### ProductDTO

```php
use Robodocxs\LaravelErpMiddleware\DTOs\ProductDTO;

$productData = [
    'id' => '1',
    'product_code' => 'ABC123',
    'product_code_2' => 'XYZ-001',
    'name' => 'Sample Product',
    'description' => 'This is a sample product',
    'base_unit_id' => 1,
    'ean' => '1234567890123'
];

$productDTO = ProductDTO::from($productData);
```

#### AccountDTO

```php
use Robodocxs\LaravelErpMiddleware\DTOs\AccountDTO;

$accountData = [
    'id' => '1',
    'erp_id' => 'ERP001',
    'vat_id' => 'VAT001',
    'name' => 'Sample Company',
    'address' => [
        'street' => 'Main St',
        'zip' => '12345',
        'city' => 'Sampleville'
    ],
    'delivery_addresses' => [],
    'invoice_addresses' => []
];

$accountDTO = AccountDTO::from($accountData);
```

### Custom Middleware

This package includes a middleware for one-time basic authentication. It's automatically applied to all API routes provided by this package. If you want to use it in your own routes, you can do so like this:

```php
Route::get('/api/example', function () {
    // Your protected route logic here
})->middleware('auth.basic.once');
```

### SFTP Operations

This package configures a new 'fileshare' disk for SFTP operations. After publishing and configuring the `sftp.php` config file, you can use it like this:

```php
use Illuminate\Support\Facades\Storage;

$disk = Storage::disk('fileshare');

// Now you can use $disk to perform SFTP operations
$contents = $disk->get('file.txt');
$disk->put('file.txt', 'Contents');
```

### CSV Handling

This package includes the league/csv package for CSV operations. Here's a basic example of reading a CSV file:

```php
use League\Csv\Reader;

$csv = Reader::createFromPath('/path/to/your/csv/file.csv', 'r');
$csv->setHeaderOffset(0);

foreach ($csv as $record) {
    // Process each record
}
```

For more detailed usage instructions for SFTP and CSV operations, please refer to the respective package documentation:
- [league/flysystem-sftp-v3 documentation](https://flysystem.thephpleague.com/docs/adapter/sftp-v3/)
- [league/csv documentation](https://csv.thephpleague.com/)

## Testing

To run the package tests, use:

```bash
composer test
```

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

The MIT License (MIT).

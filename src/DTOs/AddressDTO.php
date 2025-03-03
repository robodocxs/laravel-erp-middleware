<?php

namespace Robodocxs\LaravelErpMiddleware\DTOs;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Attributes\Validation\StringType;

/**
 * @deprecated Use robodocxs/robodocxs-middleware-dtos instead
 */
class AddressDTO extends Data
{
    public function __construct(
        public string|null $id = null,
        public string|null $name = null,
        public string|null $description = null,
        public string|null $street = null,
        public string|null $house_number = null,
        public string|null $zip = null,
        public string|null $city = null,
        public string|null $country_code = null,
        public string|null $type = null,
    )
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            name: $data['name'] ?? null,
            description: $data['description'] ?? null,
            street: $data['street'] ?? null,
            house_number: $data['house_number'] ?? null,
            zip: $data['zip'] ?? null,
            city: $data['city'] ?? null,
            country_code: $data['country_code'] ?? null,
            type: $data['type'] ?? null
        );
    }
}

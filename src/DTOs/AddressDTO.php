<?php

namespace Robodocxs\LaravelErpMiddleware\DTOs;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Attributes\Validation\StringType;

class AddressDTO extends Data
{
    public function __construct(
        #[Nullable, StringType]
        public ?string $id,

        #[Nullable, StringType]
        public ?string $name,

        #[Nullable, StringType]
        public ?string $description,

        #[Nullable, StringType]
        public ?string $street,

        #[Nullable, StringType]
        public ?string $house_number,

        #[Nullable, StringType]
        public ?string $zip,

        #[Nullable, StringType]
        public ?string $city,

        #[Nullable, StringType]
        public ?string $country_code,

        #[Nullable, StringType]
        public ?string $type
    ) {}

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

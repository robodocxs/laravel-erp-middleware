<?php

namespace Robodocxs\LaravelErpMiddleware\DTOs;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Attributes\Validation\StringType;

class ContactDTO extends Data
{
    public function __construct(
        #[Nullable, StringType]
        public ?string $id,

        #[Nullable, StringType]
        public ?string $first_name,

        #[Nullable, StringType]
        public ?string $last_name,

        #[Nullable, StringType]
        public ?string $email,

        #[Nullable, StringType]
        public ?string $phone
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            first_name: $data['first_name'] ?? null,
            last_name: $data['last_name'] ?? null,
            email: $data['email'] ?? null,
            phone: $data['phone'] ?? null
        );
    }
}

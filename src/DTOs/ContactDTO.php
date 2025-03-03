<?php

namespace Robodocxs\LaravelErpMiddleware\DTOs;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Attributes\Validation\StringType;

/**
 * @deprecated Use robodocxs/robodocxs-middleware-dtos instead
 */
class ContactDTO extends Data
{
    public function __construct(
        public string|null $id = null,
        public string|null $first_name = null,
        public string|null $last_name = null,
        public string|null $email = null,
        public string|null $phone = null,
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

<?php

namespace Robodocxs\LaravelErpMiddleware\DTOs;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;

/**
 * @deprecated Use robodocxs/robodocxs-middleware-dtos instead
 */
class CustomOrderCodeDTO extends Data
{
    public function __construct(
        public string|null $product_code = null,
        public string|null $custom_product_code = null,
    )
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            product_code: $data['product_code'] ?? null,
            custom_product_code: $data['custom_product_code'] ?? null
        );
    }
}

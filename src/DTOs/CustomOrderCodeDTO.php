<?php

namespace Robodocxs\LaravelErpMiddleware\DTOs;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;

class CustomOrderCodeDTO extends Data
{
    public function __construct(
        #[Required, StringType]
        public string $product_code,

        #[Required, StringType]
        public string $custom_product_code
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            product_code: $data['product_code'],
            custom_product_code: $data['custom_product_code']
        );
    }
}

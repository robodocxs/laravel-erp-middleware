<?php

namespace Robodocxs\LaravelErpMiddleware\DTOs;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Attributes\Validation\IntegerType;

/**
 * @deprecated Use robodocxs/robodocxs-middleware-dtos instead
 */
class PARequestDTO extends Data
{
    public function __construct(
        public string|null $id = null,
        public string|null $product_code = null,
        public int|null    $quantity = null,
    )
    {
    }
}

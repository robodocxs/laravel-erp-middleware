<?php

namespace Robodocxs\LaravelErpMiddleware\DTOs;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Attributes\Validation\IntegerType;

class PARequestDTO extends Data
{
    public function __construct(
        #[Required, StringType]
        public string $id,

        #[Required, StringType]
        public string $product_code,

        #[Required, IntegerType]
        public int $quantity
    ) {}
}

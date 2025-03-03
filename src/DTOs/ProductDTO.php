<?php

namespace Robodocxs\LaravelErpMiddleware\DTOs;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

/**
 * @deprecated Use robodocxs/robodocxs-middleware-dtos instead
 */
class ProductDTO extends Data
{
    public function __construct(
        public string|null         $id = null,
        public string|null         $product_code = null,
        public string|null         $product_code_2 = null,
        public string|null         $name = null,
        public string|null         $description = null,
        public string|int|null     $base_unit_id = null,
        public string|null         $ean = null,
        public float|null          $unit_price = null,
        public float|null          $weight = null,

        #[DataCollectionOf(UnitConversionDTO::class)]
        public DataCollection|null $unit_conversions = null,
    )
    {
    }

    public static function fromArray(array $data): self
    {
        return self::from($data);
    }
}

<?php

namespace Robodocxs\LaravelErpMiddleware\DTOs;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Attributes\Validation\IntegerType;

class ProductDTO extends Data
{
    /** @var array<int, array{unit_id: int|string|null, value: float|null}> */
    public array $unit_conversions = [];

    public function __construct(
        #[Nullable, StringType]
        public ?string $id,

        #[Nullable, StringType]
        public ?string $product_code,

        #[Nullable, StringType]
        public ?string $product_code_2,

        #[Nullable, StringType]
        public ?string $name,

        #[Nullable, StringType]
        public ?string $description,

        #[Nullable, StringType]
        public string|int|null $base_unit_id,

        #[Nullable, StringType]
        public ?string $ean,

        #[Nullable]
        public ?float $unit_price,

        #[Nullable]
        public ?float $weight,
    ) {}

    public static function fromArray(array $data): self
    {
        $product = new self(
            id: $data['id'] ?? null,
            product_code: $data['product_code'] ?? null,
            product_code_2: $data['product_code_2'] ?? null,
            name: $data['name'] ?? null,
            description: $data['description'] ?? null,
            base_unit_id: $data['base_unit_id'] ?? null,
            ean: $data['ean'] ?? null,
            unit_price: $data['unit_price'] ?? null,
            weight: $data['weight'] ?? null,
        );

        if (isset($data['unit_conversions']) && is_array($data['unit_conversions'])) {
            foreach ($data['unit_conversions'] as $conversion) {
                $product->addUnitConversion(
                    unitId: $conversion['unit_id'] ?? null,
                    value: $conversion['value'] ?? null
                );
            }
        }

        return $product;
    }

    public function addUnitConversion(int|string|null $unitId, float|null $value): self
    {
        $this->unit_conversions[] = [
            'unit_id' => $unitId,
            'value' => $value
        ];

        return $this;
    }
}

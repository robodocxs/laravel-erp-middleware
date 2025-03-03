<?php

namespace Robodocxs\LaravelErpMiddleware\DTOs;

use Spatie\LaravelData\Data;

/**
 * @deprecated Use robodocxs/robodocxs-middleware-dtos instead
 */
class UnitConversionDTO extends Data
{
    public function __construct(
        public string|null $unit_id = null,
        public float|null $value = null,
    )
    {
    }
}
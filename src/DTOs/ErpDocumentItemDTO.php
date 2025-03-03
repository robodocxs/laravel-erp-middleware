<?php

namespace Robodocxs\LaravelErpMiddleware\DTOs;

use Carbon\Carbon;
use Spatie\LaravelData\Data;

/**
 * @deprecated Use robodocxs/robodocxs-middleware-dtos instead
 */
class ErpDocumentItemDTO extends Data
{
    public function __construct(
        public string|null $id = null,
        public string|null $line_item_number = null,
        public string|null $name = null,
        public float|null $quantity = null,
    )
    {
    }
}

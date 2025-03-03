<?php

namespace Robodocxs\LaravelErpMiddleware\DTOs;

use Carbon\Carbon;
use Robodocxs\RobodocxsMiddlewareDtos\Enums\ErpDocumentType;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

/**
 * @deprecated Use robodocxs/robodocxs-middleware-dtos instead
 */
class ErpDocumentDTO extends Data
{
    public function __construct(
        public string|null          $id = null,
        public ErpDocumentType|null $erp_document_type = null,
        public string|null          $blanket_order_erp_id = null,
        public string|null          $quote_erp_id = null,
        public float|null           $total_value = null,
        public Carbon|null          $created_at = null,
        public Carbon|null          $valid_until = null,

        #[DataCollectionOf(ErpDocumentItemDTO::class)]
        public DataCollection|null  $items = null,
    )
    {

    }
}

<?php

namespace Robodocxs\LaravelErpMiddleware\Enums;

/**
 * @deprecated Use robodocxs/robodocxs-middleware-dtos instead
 */
enum ErpDocumentType: string
{
    case BLANKET_ORDER = 'blanket_order';
    case ORDER = 'order';
    case QUOTE = 'quote';
}
<?php

namespace Robodocxs\LaravelErpMiddleware\DTOs;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Attributes\Validation\StringType;

/**
 * @deprecated Use robodocxs/robodocxs-middleware-dtos instead
 */
class AccountDTO extends Data
{
    public function __construct(
        public string|null         $id = null,
        public string|null         $id_2 = null,
        public string|null         $vat_id = null,
        public string|null         $ean = null,
        public string|null         $name = null,
        public string|null         $description = null,
        public string|null         $contact = null,
        public string|null         $email = null,
        public AddressDTO|null     $address = null,

        #[DataCollectionOf(AddressDTO::class)]
        public DataCollection|null $delivery_addresses = null,

        #[DataCollectionOf(AddressDTO::class)]
        public DataCollection|null $invoice_addresses = null
    )
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            id_2: $data['id_2'] ?? null,
            vat_id: $data['vat_id'] ?? null,
            ean: $data['ean'] ?? null,
            name: $data['name'] ?? null,
            description: $data['description'] ?? null,
            contact: $data['contact'] ?? null,
            email: $data['email'] ?? null,
            address: isset($data['address']) ? AddressDTO::from($data['address']) : null,
            delivery_addresses: isset($data['delivery_addresses'])
                ? AddressDTO::collection($data['delivery_addresses'])
                : null,
            invoice_addresses: isset($data['invoice_addresses'])
                ? AddressDTO::collection($data['invoice_addresses'])
                : null
        );
    }
}

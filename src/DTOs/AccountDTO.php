<?php

namespace Robodocxs\LaravelErpMiddleware\DTOs;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Attributes\Validation\StringType;

class AccountDTO extends Data
{
    public function __construct(
        #[Nullable, StringType]
        public ?string         $id,

        #[Nullable, StringType]
        public ?string         $id_2,

        #[Nullable, StringType]
        public ?string         $vat_id,

        #[Nullable, StringType]
        public ?string         $ean,

        #[Nullable, StringType]
        public ?string         $name,

        #[Nullable, StringType]
        public ?string         $description,

        #[Nullable, StringType]
        public ?string         $contact,

        #[Nullable, StringType]
        public ?string         $email,

        public ?AddressDTO     $address,

        #[DataCollectionOf(AddressDTO::class)]
        public ?DataCollection $delivery_addresses,

        #[DataCollectionOf(AddressDTO::class)]
        public ?DataCollection $invoice_addresses
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

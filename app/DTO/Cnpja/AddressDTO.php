<?php

namespace App\DTO\Cnpja;

readonly class AddressDTO
{
    public function __construct(
        public ?int $municipalityCode,
        public ?string $street,
        public ?string $number,
        public ?string $details,
        public ?string $district,
        public ?string $city,
        public ?string $state,
        public ?string $zip,
        public CountryDTO $country
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            municipalityCode: $data['municipality'] ?? null,
            street: $data['street'] ?? null,
            number: $data['number'] ?? null,
            details: $data['details'] ?? null,
            district: $data['district'] ?? null,
            city: $data['city'] ?? null,
            state: $data['state'] ?? null,
            zip: $data['zip'] ?? null,
            country: CountryDTO::fromArray($data['country'] ?? []),
        );
    }
}

<?php

namespace App\DTO\Xml\Tags;

use SimpleXMLElement;

readonly class ProtNFeDTO
{
    public function __construct(
        public string $version,
        public InfProtDTO $infProt
    ) {}

    public static function fromXml(SimpleXMLElement $xml): self
    {
        return new self(
            version: (string)$xml['versao'],
            infProt: InfProtDTO::fromXml($xml->infProt)
        );
    }
}

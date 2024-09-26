<?php

namespace App\DTO\Xml\Tags;

use SimpleXMLElement;

readonly class DestDTO
{
    public function __construct(
        public ?string $CNPJ,
        public ?string $CPF,
        public string $xNome,
        public EnderDestDTO $enderDest,
        public ?string $indIEDest,
        public ?string $IE,
        public ?string $ISUF,
        public ?string $email
    ) {}

    public static function fromXml(SimpleXMLElement $xml): self
    {
        return new self(
            CNPJ: isset($xml->CNPJ) ? (string)$xml->CNPJ : null,
            CPF: isset($xml->CPF) ? (string)$xml->CPF : null,
            xNome: (string)$xml->xNome,
            enderDest: EnderDestDTO::fromXml($xml->enderDest),
            indIEDest: isset($xml->indIEDest) ? (string)$xml->indIEDest : null,
            IE: isset($xml->IE) ? (string)$xml->IE : null,
            ISUF: isset($xml->ISUF) ? (string)$xml->ISUF : null,
            email: isset($xml->email) ? (string)$xml->email : null
        );
    }
}

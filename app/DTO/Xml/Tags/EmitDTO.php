<?php

namespace App\DTO\Xml\Tags;

use SimpleXMLElement;

readonly class EmitDTO
{
    public function __construct(
        public string $CNPJ,
        public string $xNome,
        public ?string $xFant,
        public EnderEmitDTO $enderEmit,
        public ?string $IE,
        public ?string $IEST,
        public ?string $IM,
        public ?string $CNAE,
        public ?string $CRT
    ) {}

    public static function fromXml(SimpleXMLElement $xml): self
    {
        return new self(
            CNPJ: (string)$xml->CNPJ,
            xNome: (string)$xml->xNome,
            xFant: isset($xml->xFant) ? (string)$xml->xFant : null,
            enderEmit: EnderEmitDTO::fromXml($xml->enderEmit),
            IE: isset($xml->IE) ? (string)$xml->IE : null,
            IEST: isset($xml->IEST) ? (string)$xml->IEST : null,
            IM: isset($xml->IM) ? (string)$xml->IM : null,
            CNAE: isset($xml->CNAE) ? (string)$xml->CNAE : null,
            CRT: isset($xml->CRT) ? (string)$xml->CRT : null
        );
    }
}

<?php

namespace App\DTO\Xml\Tags;

use SimpleXMLElement;

readonly class InfProtDTO
{
    public function __construct(
        public ?string $Id,
        public string $tpAmb,
        public string $verAplic,
        public string $chNFe,
        public string $dhRecbto,
        public string $nProt,
        public ?string $digVal,
        public string $cStat,
        public string $xMotivo
    ) {}

    public static function fromXml(SimpleXMLElement $xml): self
    {
        return new self(
            Id: isset($xml['Id']) ? (string) $xml['Id'] : null,
            tpAmb: (string)$xml->tpAmb,
            verAplic: (string)$xml->verAplic,
            chNFe: (string)$xml->chNFe,
            dhRecbto: (string)$xml->dhRecbto,
            nProt: (string)$xml->nProt,
            digVal: isset($xml->digVal) ? (string)$xml->digVal : null,
            cStat: (string)$xml->cStat,
            xMotivo: (string)$xml->xMotivo
        );
    }
}

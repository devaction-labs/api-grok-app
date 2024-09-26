<?php

namespace App\DTO\Xml\Tags;

use SimpleXMLElement;

readonly class EnderDestDTO
{
    public function __construct(
        public string $xLgr,
        public string $nro,
        public ?string $xCpl,
        public string $xBairro,
        public string $cMun,
        public string $xMun,
        public string $UF,
        public string $CEP,
        public ?string $cPais,
        public ?string $xPais,
        public ?string $fone
    ) {}

    public static function fromXml(SimpleXMLElement $xml): self
    {
        return new self(
            xLgr: (string)$xml->xLgr,
            nro: (string)$xml->nro,
            xCpl: isset($xml->xCpl) ? (string)$xml->xCpl : null,
            xBairro: (string)$xml->xBairro,
            cMun: (string)$xml->cMun,
            xMun: (string)$xml->xMun,
            UF: (string)$xml->UF,
            CEP: (string)$xml->CEP,
            cPais: isset($xml->cPais) ? (string)$xml->cPais : null,
            xPais: isset($xml->xPais) ? (string)$xml->xPais : null,
            fone: isset($xml->fone) ? (string)$xml->fone : null
        );
    }
}

<?php

namespace App\DTO\Xml\Tags;

use SimpleXMLElement;

readonly class ProdDTO
{
    public function __construct(
        public string $cProd,
        public ?string $cEAN,
        public ?string $cBarra,
        public string $xProd,
        public string $NCM,
        public ?string $CEST,
        public ?string $CFOP,
        public ?string $uCom,
        public ?float $qCom,
        public ?float $vUnCom,
        public ?float $vProd,
        public ?string $cEANTrib,
        public ?string $cBarraTrib,
        public ?string $uTrib,
        public ?float $qTrib,
        public ?float $vUnTrib,
        public ?float $vFrete,
        public ?float $vSeg,
        public ?float $vDesc,
        public ?float $vOutro,
        public string $indTot,
        public ?string $nItemPed,
        public ?string $nFCI,
    ) {}

    public static function fromXml(SimpleXMLElement $xml): self
    {
        return new self(
            cProd: (string)$xml->cProd,
            cEAN: isset($xml->cEAN) ? (string)$xml->cEAN : null,
            cBarra: isset($xml->cBarra) ? (string)$xml->cBarra : null,
            xProd: (string)$xml->xProd,
            NCM: (string)$xml->NCM,
            CEST: isset($xml->CEST) ? (string)$xml->CEST : null,
            CFOP: isset($xml->CFOP) ? (string)$xml->CFOP : null,
            uCom: isset($xml->uCom) ? (string)$xml->uCom : null,
            qCom: isset($xml->qCom) ? (float)$xml->qCom : null,
            vUnCom: isset($xml->vUnCom) ? (float)$xml->vUnCom : null,
            vProd: isset($xml->vProd) ? (float)$xml->vProd : null,
            cEANTrib: isset($xml->cEANTrib) ? (string)$xml->cEANTrib : null,
            cBarraTrib: isset($xml->cBarraTrib) ? (string)$xml->cBarraTrib : null,
            uTrib: isset($xml->uTrib) ? (string)$xml->uTrib : null,
            qTrib: isset($xml->qTrib) ? (float)$xml->qTrib : null,
            vUnTrib: isset($xml->vUnTrib) ? (float)$xml->vUnTrib : null,
            vFrete: isset($xml->vFrete) ? (float)$xml->vFrete : null,
            vSeg: isset($xml->vSeg) ? (float)$xml->vSeg : null,
            vDesc: isset($xml->vDesc) ? (float)$xml->vDesc : null,
            vOutro: isset($xml->vOutro) ? (float)$xml->vOutro : null,
            indTot: (string)$xml->indTot,
            nItemPed: isset($xml->nItemPed) ? (string)$xml->nItemPed : null,
            nFCI: isset($xml->nFCI) ? (string)$xml->nFCI : null,
        );
    }
}

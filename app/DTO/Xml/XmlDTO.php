<?php

namespace App\DTO\Xml;

use App\DTO\Xml\Tags\{DestDTO, EmitDTO, ProdDTO, ProtNFeDTO};
use SimpleXMLElement;

readonly class XmlDTO
{
    public function __construct(
        public EmitDTO $emit,
        public DestDTO $dest,
        public array $products,
        public ProtNFeDTO $protNFe
    ) {}

    public static function fromXml(SimpleXMLElement $xml): self
    {
        $products = [];

        foreach ($xml->NFe->infNFe->det as $det) {
            $products[] = ProdDTO::fromXml($det->prod);
        }

        return new self(
            emit: EmitDTO::fromXml($xml->NFe->infNFe->emit),
            dest: DestDTO::fromXml($xml->NFe->infNFe->dest),
            products: $products,
            protNFe: ProtNFeDTO::fromXml($xml->protNFe)
        );
    }

}

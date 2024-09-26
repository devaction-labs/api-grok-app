<?php

namespace App\DTO\Xml;

use App\Models\Tenant;
use SimpleXMLElement;

readonly class XmlProcessingDTO
{
    public function __construct(
        public SimpleXMLElement $xml,
        public Tenant $tenant
    ) {}
}

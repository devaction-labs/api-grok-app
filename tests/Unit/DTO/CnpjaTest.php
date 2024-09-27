<?php

use App\DTO\Cnpja\CnpjDataDTO;

it('can map the CNPJ response to CnpjDataDTO', function () {
    $mockResponse = getDTOMockCnpjResponse();

    $cnpjDataDTO = CnpjDataDTO::fromArray($mockResponse);

    expect($cnpjDataDTO->taxId)->toBe('52308857000177')
        ->and($cnpjDataDTO->company->name)->toBe('52.308.857 ALEX NOGUEIRA DA SILVA')
        ->and($cnpjDataDTO->mainActivity->id)->toBe(8219999)
        ->and($cnpjDataDTO->status->text)->toBe('Ativa')
        ->and($cnpjDataDTO->address->city)->toBe('Feira de Santana')
        ->and($cnpjDataDTO->address->state)->toBe('BA')
        ->and($cnpjDataDTO->phones[0]->number)->toBe('99129511')
        ->and($cnpjDataDTO->sideActivities[0]->id)->toBe(9511800);

});

it('can map the CNPJ response to CnpjDataDTO including members', function () {

    $mockResponse = getDTOMockCnpjResponse();

    $cnpjDataDTO = CnpjDataDTO::fromArray($mockResponse);

    expect($cnpjDataDTO->taxId)->toBe('52308857000177')
        ->and($cnpjDataDTO->company->name)->toBe('52.308.857 ALEX NOGUEIRA DA SILVA')
        ->and($cnpjDataDTO->mainActivity->id)->toBe(8219999)
        ->and($cnpjDataDTO->company->members)->toHaveCount(1);

    $member = $cnpjDataDTO->company->members[0];
    expect($member->person->name)->toBe('Alex Nogueira da Silva')
        ->and($member->person->taxId)->toBe('12345678901')
        ->and($member->role->text)->toBe('Sócio');
});

function getDTOMockCnpjResponse(): array
{
    return [
        'updated' => '2024-09-14T00:00:00.000Z',
        'taxId'   => '52308857000177',
        'company' => [
            'id'     => 52308857,
            'name'   => '52.308.857 ALEX NOGUEIRA DA SILVA',
            'equity' => 10000,
            'nature' => [
                'id'   => 2135,
                'text' => 'Empresário (Individual)',
            ],
            'size' => [
                'id'      => 1,
                'acronym' => 'ME',
                'text'    => 'Microempresa',
            ],
            'members' => [
                [
                    'since' => '2023-09-25',
                    'role'  => [
                        'id'   => 22,
                        'text' => 'Sócio',
                    ],
                    'person' => [
                        'id'    => '1d23f872-4212-4996-8d9d-77cfd973a52c',
                        'name'  => 'Alex Nogueira da Silva',
                        'type'  => 'NATURAL',
                        'taxId' => '12345678901',
                        'age'   => '30-35',
                    ],
                ],
            ],
        ],
        'alias'      => null,
        'founded'    => '2023-09-25',
        'head'       => true,
        'statusDate' => '2023-09-25',
        'status'     => [
            'id'   => 2,
            'text' => 'Ativa',
        ],
        'address' => [
            'municipality' => 2910800,
            'street'       => 'Rua Trigemeos',
            'number'       => '175',
            'details'      => null,
            'district'     => 'Tomba',
            'city'         => 'Feira de Santana',
            'state'        => 'BA',
            'zip'          => '44090778',
            'country'      => [
                'id'   => 76,
                'name' => 'Brasil',
            ],
        ],
        'phones' => [
            [
                'area'   => '75',
                'number' => '99129511',
            ],
        ],
        'emails' => [
            [
                'address' => 'alex@devaction.com.br',
                'domain'  => 'devaction.com.br',
            ],
        ],
        'mainActivity' => [
            'id'   => 8219999,
            'text' => 'Preparação de documentos e serviços especializados de apoio administrativo não especificados anteriormente',
        ],
        'sideActivities' => [
            [
                'id'   => 9511800,
                'text' => 'Reparação e manutenção de computadores e de equipamentos periféricos',
            ],
        ],
        'registrations' => [
            [
                'state'      => 'BA',
                'number'     => '211140010',
                'enabled'    => true,
                'statusDate' => '2023-09-26',
                'status'     => [
                    'id'   => 1,
                    'text' => 'Sem restrição',
                ],
                'type' => [
                    'id'   => 1,
                    'text' => 'IE Normal',
                ],
            ],
        ],
    ];
}

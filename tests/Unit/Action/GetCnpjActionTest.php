<?php

use App\Actions\Cnpja\{GetCnpjAction, SaveCnpjDataAction};
use App\DTO\Cnpja\CnpjDataDTO;
use App\Http\Integrations\Cnpja\Requests\ConsultCnpjRequest;
use App\Models\Tenant;
use Saloon\Http\Faking\{MockClient, MockResponse};

it('mocks CNPJ API call and verifies full response', function () {
    (new MockClient([
        ConsultCnpjRequest::class => MockResponse::make(getActionMockCnpjResponse(), 200),
    ]));

    $action  = new GetCnpjAction();
    $cnpjDTO = $action->execute('52308857000177');

    expect($cnpjDTO)->toBeInstanceOf(CnpjDataDTO::class)
        ->and($cnpjDTO->taxId)->toBe('52308857000177')
        ->and($cnpjDTO->company->name)->toBe('52.308.857 ALEX NOGUEIRA DA SILVA');
});

it('saves CNPJ data correctly', function () {

    $mockCnpjDTO = CnpjDataDTO::fromArray(getActionMockCnpjResponse());

    $entity = Tenant::factory()->create();

    $action = new SaveCnpjDataAction();
    $action->execute($mockCnpjDTO, $entity);

    $this->assertDatabaseHas('companies', [
        'name'   => '52.308.857 ALEX NOGUEIRA DA SILVA',
        'equity' => 10000,
    ]);

    $this->assertDatabaseHas('addresses', [
        'street' => 'Rua Trigemeos',
        'city'   => 'Feira de Santana',
    ]);
});

function getActionMockCnpjResponse(): array
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
            'members' => [],
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

<?php

use App\Events\User\UserRegistered;
use App\Http\Integrations\Cnpja\Requests\ConsultCnpjRequest;
use App\Http\Integrations\Connector\CnpjaConnector;
use App\Jobs\Onboarding\OnboardingJob;
use App\Models\User;
use Illuminate\Support\Facades\{Event, Queue};

use function Pest\Laravel\postJson;

use Saloon\Http\Faking\{MockClient, MockResponse};

it('dispatches the OnboardingJob and fires UserRegistered event', function () {
    Queue::fake();
    Event::fake();

    $data = [
        'tenant_tax_id' => '12345678901',
        'tenant_name'   => 'Test Tenant',
        'tenant_slug'   => 'test-tenant',
        'tenant_domain' => 'test.com',
        'name'          => 'Test User',
        'email'         => 'test@example.com',
        'password'      => 'password',
    ];

    postJson(route('onboarding.register'), $data)
        ->assertStatus(201)
        ->assertJson(['message' => 'User created successfully']);

    Queue::assertPushed(OnboardingJob::class, function ($job) use ($data) {
        return $job->data == $data;
    });

});

it('dispatches the UserRegistered event', function () {
    Event::fake();

    $user = User::factory()->create();

    event(new UserRegistered($user));

    Event::assertDispatched(UserRegistered::class, function ($event) use ($user) {
        return $event->user->id === $user->id;
    });
});

it('mocks CNPJ API call and verifies full response', function () {

    $mockClient = new MockClient([
        ConsultCnpjRequest::class => MockResponse::make(getMockCnpjResponse(), 200),
    ]);

    $response = (new CnpjaConnector())->send(new ConsultCnpjRequest('52308857000177'));

    expect($response->json())->toBe(getMockCnpjResponse());
});

function getMockCnpjResponse(): array
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

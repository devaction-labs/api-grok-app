<?php

namespace App\Actions\Cnpja;

use App\Contracts\Cnpja\HasCnpjData;
use App\DTO\Cnpja\CnpjDataDTO;
use App\Models\Cnpja\{Company, Country, Member, MemberRole, Nature, Person, RegistrationType, Size, Status};
use Illuminate\Support\Facades\DB;

class SaveCnpjDataAction
{
    public function execute(CnpjDataDTO $dto, HasCnpjData $entity): void
    {
        DB::transaction(static function () use ($dto, $entity) {

            $entityId   = $entity->getId();
            $entityType = $entity->getEntityType();

            $nature = Nature::query()->firstOrCreate(
                ['code' => $dto->company->nature->id],
                ['text' => $dto->company->nature->text]
            );

            $size = Size::query()->firstOrCreate(
                ['code' => $dto->company->size->id],
                ['acronym' => $dto->company->size->acronym, 'text' => $dto->company->size->text]
            );

            /** @var Company $company */
            $company = $entity->company()->updateOrCreate(
                [
                    'entity_id'   => $entityId,
                    'entity_type' => $entityType,
                ],
                [
                    'name'      => $dto->company->name,
                    'equity'    => $dto->company->equity,
                    'nature_id' => $nature->id,
                    'size_id'   => $size->id,
                ]
            );

            $country = Country::query()->firstOrCreate(
                ['code' => $dto->address->country->id],
                ['name' => $dto->address->country->name]
            );

            $entity->addresses()->updateOrCreate(
                [
                    'entity_id'   => $entityId,
                    'entity_type' => $entityType,
                ],
                [
                    'municipality_code' => $dto->address->municipalityCode,
                    'street'            => $dto->address->street,
                    'number'            => $dto->address->number,
                    'details'           => $dto->address->details,
                    'district'          => $dto->address->district,
                    'city'              => $dto->address->city,
                    'state'             => $dto->address->state,
                    'zip'               => $dto->address->zip,
                    'tax_country_id'    => $country->id,
                ]
            );

            foreach ($dto->emails as $emailDTO) {
                $entity->emails()->firstOrCreate(
                    ['email' => $emailDTO->address],
                    ['domain' => $emailDTO->domain]
                );
            }

            foreach ($dto->phones as $phoneDTO) {
                $entity->phones()->firstOrCreate(
                    ['number' => $phoneDTO->number],
                    ['area' => $phoneDTO->area]
                );
            }

            $mainActivity = $dto->mainActivity;
            $entity->activities()->firstOrCreate(
                ['code' => $mainActivity->id],
                ['text' => $mainActivity->text]
            );

            foreach ($dto->sideActivities as $activityDTO) {
                $entity->activities()->firstOrCreate(
                    ['code' => $activityDTO->id],
                    ['text' => $activityDTO->text]
                );
            }

            foreach ($dto->registrations as $registrationDTO) {
                $status = Status::query()->firstOrCreate(
                    ['code' => $registrationDTO->status->id],
                    ['text' => $registrationDTO->status->text]
                );

                $type = RegistrationType::query()->firstOrCreate(
                    ['code' => $registrationDTO->type->id],
                    ['text' => $registrationDTO->type->text]
                );

                $entity->registrations()->updateOrCreate(
                    ['state' => $registrationDTO->state],
                    [
                        'number'               => $registrationDTO->number,
                        'enabled'              => $registrationDTO->enabled,
                        'status_date'          => $registrationDTO->statusDate,
                        'tax_status_id'        => $status->id,
                        'registration_type_id' => $type->id,
                    ]
                );
            }

            foreach ($dto->company->members as $memberDTO) {
                $role = MemberRole::query()->firstOrCreate(
                    ['code' => $memberDTO->role->id],
                    ['text' => $memberDTO->role->text]
                );

                /** @var Person $person */
                $person = $entity->people()->firstOrCreate(
                    ['tax_id' => $memberDTO->person->taxId],
                    [
                        'name' => $memberDTO->person->name,
                        'type' => $memberDTO->person->type,
                        'age'  => $memberDTO->person->age,
                    ]
                );

                Member::query()->updateOrCreate(
                    [
                        'entity_id'   => $entityId,
                        'entity_type' => $entityType,
                        'person_id'   => $person->id,
                    ],
                    [
                        'since'          => $memberDTO->since,
                        'member_role_id' => $role->id,
                        'company_id'     => $company->id,
                    ]
                );
            }
        });
    }
}

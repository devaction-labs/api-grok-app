<?php

namespace Database\Factories;

use App\Models\Permission\{Permission, Role};
use App\Models\{Tenant, User};
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected static ?string $password = null;

    protected ?Role $role = null;

    protected array $permissions = [];

    public function definition(): array
    {
        return [
            'name'              => fake()->name(),
            'email'             => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => 'password',
            'remember_token'    => Str::random(10),
            'tenant_id'         => TenantFactory::new(),
        ];
    }

    /**
     * Define uma role específica para o usuário.
     *
     * @param string $roleName
     * @param Tenant|null $tenant
     * @return $this
     */
    public function role(string $roleName, ?Tenant $tenant = null): static
    {
        $this->role = Role::firstOrCreate([
            'name'      => $roleName,
            'tenant_id' => $tenant->id ?? null,
        ]);

        return $this;
    }

    /**
     * Sobrescreve o método create para adicionar role e permissões.
     *
     * @param array<string, mixed> $attributes
     * @param Model|null $parent
     * @return User
     */
    public function create($attributes = [], ?Model $parent = null): User
    {
        $user = parent::create($attributes, $parent);

        if ($this->role) {
            /** @var User $user */
            $user->assignRole($this->role);

            foreach ($this->permissions as $permissionEnum) {
                $permission = Permission::firstOrCreate(['name' => $permissionEnum->value]);
                $this->role->permissions()->attach($permission);
            }
        }

        return $user;
    }

    /**
     * Atribui permissões ao usuário baseado em enums.
     *
     * @param array $permissions
     * @return $this
     */
    public function permissions(array $permissions): static
    {
        $this->permissions = $permissions;

        return $this;
    }
}

<?php

namespace Database\Seeders\Permission;

use App\Models\Permission\{Permission, Role};
use App\Models\User;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Permissões gerais
        $permissions = [
            'user:create',
            'user:edit',
            'user:list',
            'user:delete',
            'manager:create',
            'manager:edit',
            'manager:list',
            'manager:delete',
            'admin:create',
            'admin:edit',
            'admin:list',
            'admin:delete',
        ];

        // Criar permissões no banco
        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
        }

        // Definir permissões por role
        $rolesPermissions = [
            'Admin'   => $permissions, // Admin tem todas as permissões
            'Manager' => array_filter($permissions, fn ($p) => !str_starts_with($p, 'admin')), // Manager não tem permissões de admin
            'User'    => ['user:list'], // User tem apenas a permissão de listar usuários
        ];

        // Criar roles e associar permissões
        foreach ($rolesPermissions as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);

            // Associar permissões à role
            $role->permissions()->sync(
                Permission::whereIn('name', $rolePermissions)->pluck('id')
            );
        }

        // Atribuir a role Admin a um usuário específico (baseado no email)
        $user = User::where('email', 'atest@example.com')->first();

        if ($user) {
            $user->assignRole('Admin');
        }
    }
}

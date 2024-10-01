<?php

namespace App\Http\Controllers\ACL;

use App\Enum\Authorize\PermissionsEnum;
use App\Exceptions\Authorize\AuthorizationException;
use App\Http\Controllers\Controller;
use App\Http\Requests\ACL\{PermissionRequest, PermissionUpdateRequest};
use App\Http\Resources\ACL\PermissionCollection;
use App\Models\Permission\Permission;
use App\Services\Authorize\AuthorizeAccount;
use DevactionLabs\FilterablePackage\Filter;
use Illuminate\Http\Response;

class PermissionController extends Controller
{
    /**
     * List all permissions.
     *
     * @return PermissionCollection
     * @throws AuthorizationException
     */
    public function index(): PermissionCollection
    {
        AuthorizeAccount::authorize(PermissionsEnum::VIEW_PERMISSIONS);

        $permission = Permission::query()
            ->filtrable([
                Filter::like('name', 'name'),
            ])
            ->customPaginate();

        return new PermissionCollection($permission);
    }

    /**
     * Create a new permission.
     *
     * @throws AuthorizationException
     */
    public function store(PermissionRequest $request): Response
    {
        AuthorizeAccount::authorize(PermissionsEnum::CREATE_PERMISSIONS);

        Permission::query()->create($request->validated());

        return response()->noContent();

    }

    /**
     *
     * Update a permission.
     *
     * @throws AuthorizationException
     */
    public function update(PermissionUpdateRequest $request, Permission $permission): Response
    {
        AuthorizeAccount::authorize(PermissionsEnum::EDIT_PERMISSIONS);

        $permission->update($request->validated());

        return response()->noContent();
    }
}

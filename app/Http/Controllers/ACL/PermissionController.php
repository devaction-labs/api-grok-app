<?php

namespace App\Http\Controllers\ACL;

use App\Http\Controllers\Controller;
use App\Http\Resources\ACL\PermissionCollection;
use App\Models\Permission\Permission;
use DevactionLabs\FilterablePackage\Filter;

class PermissionController extends Controller
{
    public function index(): PermissionCollection
    {
        $permission = Permission::query()
            ->filtrable([
                Filter::like('name', 'name'),
            ])
            ->paginate();

        return new PermissionCollection($permission);
    }
}

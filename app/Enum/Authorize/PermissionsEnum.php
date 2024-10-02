<?php

namespace App\Enum\Authorize;

/**
 * Class Permissions
 * @package App\Enum\Authorize
 * @property string $value
 */
enum PermissionsEnum: string
{
    case VIEW_USERS   = 'user:view';
    case CREATE_USERS = 'user:create';
    case EDIT_USERS   = 'user:edit';
    case DELETE_USERS = 'user:delete';

    case VIEW_ROLES   = 'role:view';
    case CREATE_ROLES = 'role:create';
    case EDIT_ROLES   = 'role:edit';
    case DELETE_ROLES = 'role:delete';

    case VIEW_PERMISSIONS   = 'permission:view';
    case CREATE_PERMISSIONS = 'permission:create';
    case EDIT_PERMISSIONS   = 'permission:edit';
    case DELETE_PERMISSIONS = 'permission:delete';

    case VIEW_CUSTOMERS   = 'customer:view';
    case CREATE_CUSTOMERS = 'customer:create';
    case EDIT_CUSTOMERS   = 'customer:edit';
    case DELETE_CUSTOMERS = 'customer:delete';
}

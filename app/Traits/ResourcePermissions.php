<?php
namespace App\Traits;

use App\Services\AdminService;
use Illuminate\Database\Eloquent\Model;

trait ResourcePermissions
{
    public static function canViewAny(): bool
    {
        $permissionName = 'read '. self::getPermissionName();
        return AdminService::can($permissionName);
    }

    public static function canCreate(): bool
    {
        $permissionName = 'create '. self::getPermissionName();
        return AdminService::can($permissionName);
    }

    public static function canEdit(Model $record): bool
    {
        $permissionName = 'update '. self::getPermissionName();
        return AdminService::can($permissionName);
    }

    public static function canDelete(Model $record): bool
    {
        $permissionName = 'delete '. self::getPermissionName();
        return AdminService::can($permissionName);
    }

    private static function getPermissionName() : string 
    {
        return self::$permissionName ?? "";
    }

}
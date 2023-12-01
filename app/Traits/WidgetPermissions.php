<?php
namespace App\Traits;

use App\Services\AdminService;

trait WidgetPermissions
{

    public static function canView(): bool
    {
        $permissionName = 'read '. self::getPermissionName();
        return AdminService::can($permissionName);
    }

    private static function getPermissionName() : string 
    {
        return self::$permissionName ?? "";
    }

}
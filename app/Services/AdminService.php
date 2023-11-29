<?php
namespace App\Services;

class AdminService
{
    /**
     * Admin Can
     * 
     * @param string $permission
     * 
     * @return bool
     */
    public static function can(string $permission) : bool
    {
        return auth('admin')?->user()?->can($permission);
    }
}
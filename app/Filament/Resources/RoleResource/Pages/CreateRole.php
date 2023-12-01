<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use App\Traits\ResourceRedirect;
use Filament\Resources\Pages\CreateRecord;

class CreateRole extends CreateRecord
{
    use ResourceRedirect;

    protected static string $resource = RoleResource::class;
}



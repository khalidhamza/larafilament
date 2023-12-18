<?php

namespace App\Filament\Resources\CountryResource\Pages;

use App\Filament\Resources\CountryResource;
use App\Traits\ResourcePermissions;
use App\Traits\ResourceRedirect;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCountry extends CreateRecord
{
    use ResourceRedirect, ResourcePermissions;
    
    protected static string $resource = CountryResource::class;
}

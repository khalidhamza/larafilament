<?php

namespace App\Filament\Resources\SocialMediaResource\Pages;

use App\Filament\Resources\SocialMediaResource;
use App\Traits\ResourceRedirect;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSocialMedia extends CreateRecord
{
    use ResourceRedirect;
    
    protected static string $resource = SocialMediaResource::class;
}

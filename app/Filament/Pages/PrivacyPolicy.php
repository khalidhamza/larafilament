<?php

namespace App\Filament\Pages;

use App\Traits\ContentPage;
use Filament\Pages\Page;

class PrivacyPolicy extends Page
{
    use ContentPage;

    protected static string $view = 'filament.pages.content-page';
    
    protected static ?string $slug = 'content-pages/privacy-policy';

    protected ?string $pageName = 'Privacy Policy';
    
    protected ?string $pageUrl = 'privacy-policy';

    private int $recordId = 2;
}

<?php

namespace App\Filament\Pages;

use App\Traits\ContentPage;
use Filament\Pages\Page;

class AboutUs extends Page
{
    use ContentPage;

    protected static string $view = 'filament.pages.content-page';
    
    protected static ?string $slug = 'content-pages/about-us';

    protected ?string $pageName = 'About Us';
    
    protected ?string $pageUrl = 'about-us';

    private int $recordId = 1;
}

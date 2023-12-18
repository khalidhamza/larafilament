<?php

namespace App\Filament\Pages;

use App\Traits\ContentPage;
use Filament\Pages\Page;

class TermsAndConditions extends Page
{
    use ContentPage;

    protected static string $view = 'filament.pages.content-page';
    
    protected static ?string $slug = 'content-pages/terms-and-conditions';

    protected static ?int $navigationSort = 28;

    protected ?string $pageName = 'Terms and Conditions';
    
    protected ?string $pageUrl = 'terms-and-conditions';

    private int $recordId = 3;
}

<?php
namespace App\Traits;

use App\Models\ContentPage as ModelsContentPage;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;

trait ContentPage
{
    
    public $content_ar = '';
 
    public $content_en = '';

    public static function getActiveNavigationIcon(): ?string
    {
        return 'heroicon-o-document-text';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Content Pages';
    }

    public function getHeading(): string
    {
        return __('Content Pages');
    }

    public function mount(): void
    {
        abort_unless(true, 403);

        $record = ModelsContentPage::find($this->recordId);
        if($record){
            $this->content_ar   = $record->content_ar;
            $this->content_en   = $record->content_en;
        }
    }

    public function save()
    {
        $this->validate(); 
 
        ModelsContentPage::updateOrCreate(
            ['id' => $this->recordId],
            ['content_en' => $this->content_en, 'content_ar' => $this->content_ar]
        );
        
        return $this->redirect($this->pageUrl);
    }

    public function getBreadcrumbs(): array
    {
        return [
            'Content Page', $this->pageName
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    RichEditor::make('content_ar')->required()->label('Arabic Content'),
                    RichEditor::make('content_en')->required()->label('English Content'),
                ])
            ])->columns('full');
    }
}
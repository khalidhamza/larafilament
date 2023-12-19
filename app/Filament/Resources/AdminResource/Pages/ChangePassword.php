<?php

namespace App\Filament\Resources\AdminResource\Pages;

use App\Filament\Resources\AdminResource;
use App\Models\Admin;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Log;

class ChangePassword extends Page
{
    protected static string $resource = AdminResource::class;

    protected static string $view = 'filament.resources.admin-resource.pages.change-password';
    
    private Admin $admin;

    public $password;
 
    public $confirm_password;
    
    public $admin_id;

    public function mount(int $record): void
    {
        abort_unless(true, 403);

        $this->admin = Admin::findOrFail($record);
        $this->admin_id = $record;
    }

    public function save()
    {
        $this->validate();
 
        Admin::findOrFail($this->admin_id)->update(['password' => bcrypt($this->password)]);
        
        Notification::make() 
            ->success()
            ->title('Password changed successfully')
            ->send(); 

        return $this->redirect(AdminResource::getUrl());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('password')->password()->required(),
                    TextInput::make('confirm_password')->password()->required()->same('password'),
                    Hidden::make('admin_id'),
                ])->columns(2),
            ])->columns(2);
    }
}

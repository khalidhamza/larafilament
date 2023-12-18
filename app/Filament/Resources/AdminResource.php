<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdminResource\Pages;
use App\Models\Admin;
use App\Services\AdminService;
use App\Traits\ResourcePermissions;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AdminResource extends Resource
{
    use ResourcePermissions;

    protected static ?string $model = Admin::class;

    // protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Admins Management';

    protected static ?int $navigationSort = 31;

    protected static string $permissionName = 'admins';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('name')->required(),
                    TextInput::make('email')
                        ->required()
                        ->email(),
                    Select::make('role')
                        ->required()
                        ->searchable()
                        ->preload()
                        ->relationship(
                            'roles', 
                            'name',
                            function(Builder $query){
                                if(! AdminService::hasRole('developer')){
                                    $query->where('name', '!=', 'developer');
                                }
                            }
                        ),
                    TextInput::make('password')
                        ->required()
                        ->password()
                        ->hidden(fn (Get $get) => !empty($get('id')))
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('email')->searchable()->sortable(),
                TextColumn::make('roles.name')->searchable()->sortable(),
                ToggleColumn::make('status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAdmins::route('/'),
            'create' => Pages\CreateAdmin::route('/create'),
            'edit' => Pages\EditAdmin::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where(function($q){
            if(! AdminService::hasRole('developer')){
                $q->withoutRole('developer');
            }
        });
    }
}

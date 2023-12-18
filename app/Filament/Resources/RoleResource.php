<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages\CreateRole;
use App\Filament\Resources\RoleResource\Pages\EditRole;
use App\Filament\Resources\RoleResource\Pages\ListRoles;
use App\Filament\Resources\RoleResource\RelationManagers\PermissionsRelationManager;
use App\Services\AdminService;
use App\Traits\ResourcePermissions;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Models\Role;

class RoleResource extends Resource
{
    use ResourcePermissions;
    
    protected static ?string $model = Role::class;

    // protected static ?string $navigationIcon = 'heroicon-o-cog';
    
    protected static ?string $navigationGroup  = 'Admins Management';

    protected static ?int $navigationSort = 32;
    
    protected static string $permissionName = 'roles';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('name')->required()->unique(ignoreRecord:true),
                    CheckboxList::make('permissions')
                            ->relationship(
                                'permissions', 
                                'name',
                                function(Builder $query, string $context){
                                    if(! AdminService::hasRole('developer')){
                                        $permissions    = [
                                            'create permissions',
                                            'read permissions',
                                            'update permissions',
                                            'delete permissions',
                                        ];
                                        $query->whereNotIn('name', $permissions);
                                    }
                                }
                            )
                            ->searchable()
                            ->columns(2),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                ToggleColumn::make('status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRoles ::route('/'),
            'create' => CreateRole::route('/create'),
            'edit' => EditRole ::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            PermissionsRelationManager::class
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where(function($q){
            if(! AdminService::hasRole('developer')){
                $q->where('name', '!=', 'developer');
            }
        });
    }
}

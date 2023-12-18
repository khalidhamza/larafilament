<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DeliveryPartnerResource\Pages;
use App\Filament\Resources\DeliveryPartnerResource\RelationManagers;
use App\Models\DeliveryPartner;
use App\Services\AdminService;
use App\Traits\ResourcePermissions;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DeliveryPartnerResource extends Resource
{
    use ResourcePermissions;

    protected static ?string $model = DeliveryPartner::class;

    protected static ?string $navigationGroup = 'Countries and delivery';

    protected static ?int $navigationSort = 22;

    protected static string $permissionName = 'delivery partner';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('name')->required(),
                    TextInput::make('integration_name')->nullable()
                            ->unique(ignoreRecord:true)
                            ->disabled(!AdminService::hasRole('developer'))
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('integration_name'),
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
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageDeliveryPartners::route('/'),
        ];
    }
}

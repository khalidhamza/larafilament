<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CouponResource\Pages;
use App\Filament\Resources\CouponResource\RelationManagers;
use App\Models\Coupon;
use App\Traits\ResourcePermissions;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CouponResource extends Resource
{
    use ResourcePermissions;

    protected static ?string $model = Coupon::class;

    protected static ?string $navigationGroup = 'E-Commerce';
    
    protected static string $permissionName = 'coupons';
    
    protected static ?int $navigationSort = 18;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('discount')->required()->numeric(),
                    Select::make('type')->required()->preload()->options(Coupon::getAllTypes()),
                    DatePicker::make('from_date')->required()->format('Y-m-d'),
                    DatePicker::make('to_date')->required()->format('Y-m-d')->afterOrEqual('from_date'),
                    TextInput::make('code')->required()->unique(ignoreRecord:true),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')->searchable()->sortable(),
                TextColumn::make('discount')->searchable()->sortable(), 
                TextColumn::make('type')->searchable()->sortable()
                ->formatStateUsing(fn (string $state): string => Coupon::getAllTypes()[$state] ?? ""), 
                TextColumn::make('from_date')->searchable()->sortable(), 
                TextColumn::make('to_date')->searchable()->sortable(), 
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
            'index' => Pages\ManageCoupons::route('/'),
        ];
    }
}

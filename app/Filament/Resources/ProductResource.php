<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Traits\ResourcePermissions;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    use ResourcePermissions;

    protected static ?string $model = Product::class;

    protected static ?string $navigationGroup = 'E-Commerce';
    
    protected static string $permissionName = 'products';
    
    protected static ?int $navigationSort = 17;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('name_en')->required(),
                    TextInput::make('name_ar')->required(),
                    TextInput::make('price')->required()->numeric(),
                    TextInput::make('offer_price')->nullable()->numeric(),
                    TextInput::make('quantity')->nullable()->numeric(),
                ])->columns(2),

                Section::make()->schema([
                    RichEditor::make('description_ar')->required(),
                    RichEditor::make('description_en')->required(),
                ])->columns(2),

                Section::make()->schema([
                    FileUpload::make('image')->required()->directory('products')->maxSize(1024)->image(),
                    FileUpload::make('images')->directory('products')->maxSize(1024)->multiple()->image(),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name_en')->searchable()->sortable()->label('Name'),
                TextColumn::make('quantity')->sortable(),
                TextColumn::make('price')->sortable(),
                TextColumn::make('offer_price')->sortable(),
                ImageColumn::make('image'),
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
            'index' => Pages\ManageProducts::route('/'),
        ];
    }
}

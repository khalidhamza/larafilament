<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\AdminResource;
use App\Traits\WidgetPermissions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class TodaySalesWidget extends BaseWidget
{
    use WidgetPermissions;

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Today Orders';

    protected static string $permissionName = 'admins';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                AdminResource::getEloquentQuery()
                    ->whereDate('created_at', now()->format('Y-m-d'))
            )
            ->defaultPaginationPageOption(10)
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('email'),
            ]);
    }
}

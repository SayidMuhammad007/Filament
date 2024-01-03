<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ListEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'All' => Tab::make(),
            'This week' => Tab::make()->modifyQueryUsing(fn(Builder $query) => $query->where('date_hired', '>=', now()->subWeek())),
            'This month' => Tab::make()->modifyQueryUsing(fn(Builder $query) => $query->where('date_hired', '>=', now()->subMonth())),
            'This year' => Tab::make()->modifyQueryUsing(fn(Builder $query) => $query->where('date_hired', '>=', now()->subYear())),
        ];
    }
}

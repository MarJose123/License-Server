<?php

namespace App\Filament\Resources\LicensesResource\Pages;

use App\Filament\Resources\LicensesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLicenses extends ViewRecord
{
    protected static string $resource = LicensesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

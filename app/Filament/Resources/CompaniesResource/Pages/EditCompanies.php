<?php

namespace App\Filament\Resources\CompaniesResource\Pages;

use App\Filament\Resources\CompaniesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompanies extends EditRecord
{
    protected static string $resource = CompaniesResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}

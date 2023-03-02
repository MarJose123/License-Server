<?php

namespace App\Filament\Resources\LicensesResource\Pages;

use App\Filament\Resources\LicensesResource;
use App\Helpers\LicenseKeyGenerator;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLicenses extends CreateRecord
{
    protected static string $resource = LicensesResource::class;

    /**
     * @throws \Exception
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['license_key'] = (new LicenseKeyGenerator())->generateUnique();

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

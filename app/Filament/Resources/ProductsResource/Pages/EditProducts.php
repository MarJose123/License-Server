<?php

namespace App\Filament\Resources\ProductsResource\Pages;

use App\Filament\Resources\ProductsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProducts extends EditRecord
{
    protected static string $resource = ProductsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}

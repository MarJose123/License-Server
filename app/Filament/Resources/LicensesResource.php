<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LicensesResource\Pages;
use App\Filament\Resources\LicensesResource\RelationManagers;
use App\Models\Customers;
use App\Models\Licenses;
use App\Models\Products;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LicensesResource extends Resource
{
    protected static ?string $model = Licenses::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(2)->schema([
                    Forms\Components\TextInput::make('license_key')->visible('view'),
                    Forms\Components\Select::make('customer_id')->options(Customers::all()->pluck('full_name', 'id')),
                    Forms\Components\Select::make('product_id')->options(Products::all()->pluck('name', 'id')),
                    Forms\Components\TextInput::make('user_limit')->numeric(),
                    Forms\Components\TextInput::make('domain')->url()->unique(),
                    Forms\Components\Select::make('status')->options([
                        'active' => "Active",
                        'inactive' => "In-Active",
                        'suspended' => "Suspended",
                        'expired' => "Expired",
                    ]),
                    Forms\Components\Checkbox::make('is_trial')->reactive()
                        ->disabled(fn(\Closure $get): bool =>  $get('is_lifetime') === true ?? false),
                    Forms\Components\Checkbox::make('is_lifetime')->reactive()
                    ->disabled(fn(\Closure $get): bool =>  $get('is_trial') === true ?? false),
                    Forms\Components\DatePicker::make('expiration_date')
                        ->required(fn (\Closure $get): bool => $get('is_trial') === true ?? false)
                        ->visible(fn (\Closure $get): bool => $get('is_trial') === true ?? false),
                    Forms\Components\TextInput::make('device_uuid'),
                ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product_id'),
                Tables\Columns\TextColumn::make('customer_id'),
                Tables\Columns\TextColumn::make('user_limit'),
                Tables\Columns\TextColumn::make('domain'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\CheckboxColumn::make('is_trial'),
                Tables\Columns\CheckboxColumn::make('is_lifetime'),
                Tables\Columns\TextColumn::make('expiration_date'),
                Tables\Columns\TextColumn::make('device_uuid'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLicenses::route('/'),
            'create' => Pages\CreateLicenses::route('/create'),
            'view' => Pages\ViewLicenses::route('/{record}'),
            'edit' => Pages\EditLicenses::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}

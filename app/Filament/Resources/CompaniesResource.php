<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompaniesResource\Pages;
use App\Filament\Resources\CompaniesResource\RelationManagers;
use App\Models\Companies;
use App\Models\Customers;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompaniesResource extends Resource
{
    protected static ?string $model = Companies::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('website')
                    ->maxLength(255),
                Forms\Components\TextInput::make('industry')
                    ->maxLength(255),
                Forms\Components\Select::make('company_primary_contact')
                    ->options(function (?Model $record){
                        return Customers::all()->where('company', '=', $record->id);
                    })
                    ->visibleOn('edit'),
                Forms\Components\TextInput::make('employee_size'),
                Forms\Components\Section::make('Address Information')
                    ->schema([
                        Forms\Components\Placeholder::make('billing_street'),
                        Forms\Components\Placeholder::make('shipping_street'),
                        Forms\Components\Placeholder::make('billing_city'),
                        Forms\Components\Placeholder::make('shipping_city'),
                        Forms\Components\Placeholder::make('billing_state'),
                        Forms\Components\Placeholder::make('shipping_state'),
                        Forms\Components\Placeholder::make('billing_post_code'),
                        Forms\Components\Placeholder::make('shipping_post_code'),
                    ])
                    ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('website'),
                Tables\Columns\TextColumn::make('industry'),
                Tables\Columns\TextColumn::make('company_primary_contact'),
                Tables\Columns\TextColumn::make('employee_size'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
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
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompanies::route('/create'),
            'edit' => Pages\EditCompanies::route('/{record}/edit'),
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

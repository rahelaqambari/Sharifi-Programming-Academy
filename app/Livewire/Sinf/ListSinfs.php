<?php

namespace App\Livewire\Sinf;

use App\Models\Sinf;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class ListSinfs extends Component implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithTable;
    use InteractsWithSchemas;

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Sinf::query())
            ->columns([
                //
                TextColumn::make('title')->label('Course Name')->searchable(),
                 TextColumn::make('teacher.user.name')->label('Teacher Name')->badge(),
                 TextColumn::make('payment.student.user.name')->label('students')->separator(','),
                 TextColumn::make('start_date'),
                 TextColumn::make('end_date')->toggleable(isToggledHiddenByDefault:true),
                 TextColumn::make('description')->limit(20)
                 ])
            ->filters([
                //
                Filter::make('start_date')
                ->schema([
                    DatePicker::make('start_date')
                ])
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.sinf.list-sinfs');
    }
}

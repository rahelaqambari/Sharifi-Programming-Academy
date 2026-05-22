<?php

namespace App\Livewire\Payment;

use App\Models\Payment;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;


class ListPayments extends Component implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithTable;
    use InteractsWithSchemas;

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Payment::query())
            ->columns([
                TextColumn::make('student.user.name')->label('Student Name')->searchable()->sortable(),
                TextColumn::make('sinf.title')->label('Course Name')->searchable()->sortable(),
                TextColumn::make('amount')->money('AFG'),
                TextColumn::make('created_at')->date(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
                Action::make('edit')
                ->url(fn (Payment $record): string => route('payment.update',$record))
                ->openUrlInNewTab(),
                
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
        return view('livewire.payment.list-payments');
    }
}

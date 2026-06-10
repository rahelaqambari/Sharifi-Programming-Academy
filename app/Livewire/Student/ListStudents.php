<?php

namespace App\Livewire\Student;

use App\Models\Student ;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;


class ListStudents extends Component implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithTable;
    use InteractsWithSchemas;

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Student::query())
            ->columns([
                //
                TextColumn::make('user.name')->searchable(),
                TextColumn::make('user.email')->label('Email'),
                TextColumn::make('last_name'),
                ImageColumn::make('img_url'),
                TextColumn::make('payment.sinf.user.name')->label('students')->separator(','),
                TextColumn::make('tazkira')->toggleable(isToggledHiddenByDefault:false),
                TextColumn::make('phone')->toggleable(isToggledHiddenByDefault:false),
            ])
            ->filters([
                //
                Filter::make('Student Name')
                ->label('Filter by Student Name')
                ->form([
                    TextInput::make('user.name')
                    ->label('Student Name'),
                ])
                // ->query(function (Builder $query, array $data): Builder{
                //     return $query->when(
                //         $data['start_date'],
                //         fn (Builder $query, $data): Builder =>
                //         $query->whereDate('start_date','=', $data),
                //     );
                // })
            ])
            ->headerActions([
                //
                 Action::make('createStudent')->label('Create New Student')
                ->url(route('students.create')),
            ])
            ->recordActions([
                //
                   Action::make('delete')->requiresConfirmation()->action(fn (Student $record) => $record->delete($record->id))->successNotification(
                    Notification::make()
                    ->title('Saved Successfully')->send()
                   ),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.student.list-students');
    }
}

<?php

namespace App\Livewire\Teacher;

use App\Models\Teacher;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Notifications\Notification;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;


class ListTeachers extends Component implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithTable;
    use InteractsWithSchemas;

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Teacher::query())
            ->columns([
                //
                TextColumn::make('user.name')->label('Name'),
                TextColumn::make('last_name')->sortable()->searchable(),
                TextColumn::make('degree')->badge(),
                ImageColumn::make('img_url'),
                TextColumn::make('sinfs.title')->badge()->limitList(3)->separator(','),
                TextColumn::make('phone')->toggleable(isToggledHiddenByDefault:true),
                TextColumn::make('bio')->limit(20)->toggleable(isToggledHiddenByDefault:true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
                Action::make('createTeacher')->label('Create Teacher')
                ->url(route('teachers.create')),
            ])
            ->recordActions([
                //
                 Action::make('edit')
                ->url(fn (Teacher $record): string => route('teacher.update',$record))
                ->openUrlInNewTab(),

                Action::make('delete')
                ->requiresConfirmation()
                ->action(fn (Teacher $record) => $record->delete($record->id))
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                    Action::make('delete')->requiresConfirmation()
                    ->action(fn (Teacher $record) => $record->delete($record->id))->color('danger')->successNotification(
                        Notification::make()
                        ->title('deleted successfully')
                        ->success()
                    )
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.teacher.list-teachers');
    }
}

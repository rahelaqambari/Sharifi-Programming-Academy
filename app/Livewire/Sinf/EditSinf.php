<?php

namespace App\Livewire\Sinf;

use App\Models\Sinf;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use Livewire\Component;


class EditSinf extends Component implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithSchemas;

    public Sinf $record;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                  Section::make('Edit Class Info')
                ->description('You Can Edit The Spicefic Classes Information .')
                ->columns(2)
                ->schema([
                    TextInput::make('title')->label('Course Name'),
                    DatePicker::make('start_date')->format('Y-m-d')->timezone('Asia/Kabul'),
                    DatePicker::make('end_date')->format('Y-m-d')->timezone('Asia/Kabul'),
                    Textarea::make('description')->autosize(),
                ])
            ])
            ->statePath('data')
            ->model($this->record);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $this->record->update($data);
    }

    public function render(): View
    {
        return view('livewire.sinf.edit-sinf');
    }
}

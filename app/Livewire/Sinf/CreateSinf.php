<?php

namespace App\Livewire\Sinf;

use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use App\Models\Sinf;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class CreateSinf extends Component implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithSchemas;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                 Section::make('Add New Class')
                ->description('You Can Add New Class Here.')
                ->schema([
                    // ...
                    TextInput::make('title'),
                    TextInput::make('start_date'),
                    TextInput::make('end_date'),
                    Textarea::make('description'),
                    FileUpload::make('banner_url')->directory('banner-images'),
                    TextInput::make('teacher_id'),
                ])
            ])
            ->statePath('data')
            ->model(Sinf::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = Sinf::create($data);

        $this->form->model($record)->saveRelationships();
    }

    public function render(): View
    {
        return view('livewire.sinf.create-sinf');
    }
}

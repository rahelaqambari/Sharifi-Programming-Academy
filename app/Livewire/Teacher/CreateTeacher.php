<?php

namespace App\Livewire\Teacher;

use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use App\Models\Teacher;
use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class CreateTeacher extends Component implements HasActions, HasSchemas
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
                  Section::make('Add New Teacher')
                ->description('You Can Add New Teacher Here.')
                ->schema([
                    // ...
                    TextInput::make('last_name'),
                    TextInput::make('degree'),
                    TextInput::make('phone'),
                    FileUpload::make('img_url')->directory('teacher_images')->disk('public'),
                    Textarea::make('bio')->autosize(),
                    Select::make('user_id')->options(User::query()->pluck('name','id'))->loadingMessage('Loading...')->searchable(),
                ])
            ])
            ->statePath('data')
            ->model(Teacher::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = Teacher::create($data);

        $this->form->model($record)->saveRelationships();
    }

    public function render(): View
    {
        return view('livewire.teacher.create-teacher');
    }
}

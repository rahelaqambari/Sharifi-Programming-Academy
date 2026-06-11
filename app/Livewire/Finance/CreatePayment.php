<?php

namespace App\Livewire\Finance;

use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\HtmlString;
use Livewire\Component;

class CreatePayment extends Component implements HasActions, HasSchemas
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
                Wizard::make([
                    Step::make('User')->icon(Heroicon::User)->description('Form for adding new user')->columns(2)
                    ->schema([
                    TextInput::make('name'),
                    TextInput::make('email')->required(),
                    TextInput::make('password'),
                    TextInput::make('role')->default('Student'),
                    ]),
                    Step::make('Student')->description('Form for adding new Student')->completedIcon(Heroicon::Check)->icon(Heroicon::AcademicCap)
                    ->schema([
                    TextInput::make('last_name')->required(),
                    TextInput::make('phone'),
                    TextInput::make('tazkira'),
                    FileUpload::make('img_url')->directory('student_images'),
                    ])
                ])->submitAction(new HtmlString('<button type="submite">Save</button>'))
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $data = $this->form->getState();

        //
    }

    public function render(): View
    {
        return view('livewire.finance.create-payment');
    }
}

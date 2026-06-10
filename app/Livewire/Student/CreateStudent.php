<?php

namespace App\Livewire\Student;

use App\Models\User;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\HtmlString;
use Livewire\Component;

class CreateStudent extends Component implements HasActions, HasSchemas
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
                    Step::make('User')->description('Form for adding new user')
                    ->schema([
                    TextInput::make('name'),
                    TextInput::make('email')->required(),
                    TextInput::make('password'),
                    TextInput::make('role')->default('Student'),
                    ]),
                    Step::make('Student')->description('Form for adding new Student')
                    ->schema([
                    TextInput::make('last_name')->required(),
                    TextInput::make('phone'),
                    TextInput::make('tazkira'),
                    FileUpload::make('img_url')->directory('student_images'),
                    Textarea::make('bio'),
                    ])
                ])->submitAction(new HtmlString('<button type="submite">Save</button>'))
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $data = $this->form->getState();
        $data = $this->form->getState();
        DB::transaction(function () use ($data){
           $user = User::create([
                'name'=> $data['name'],
                'email'=> $data['email'],
                'password'=> $data['password'],
                'role'=> 'student',
            ]);
            $user->student()->create([
             'last_name'=> $data['last_name'],
                'phone'=> $data['phone'],
                'img_url'=> $data['img_url'],
                'tazkira'=> $data['tazkira'],
                'bio'=> 'bio',
            ]);
            return redirect()->route('students.index');
        });
        //
    }

    public function render(): View
    {
        return view('livewire.student.create-student');
    }
}

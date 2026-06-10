<?php

namespace App\Livewire\Teacher;

use App\Models\User;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
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
                //
                Wizard::make([
                    Step::make('User')
                    ->schema([
                    TextInput::make('name'),
                    TextInput::make('email')->required(),
                    TextInput::make('password'),
                    TextInput::make('role')->default('teacher'),
                    ]),
                    Step::make('Teacher')
                    ->schema([
                    TextInput::make('last_name')->required(),
                    Select::make('degree')
                    ->options([
                        'Secondry School' => 'Secondry School',
                        'Bachelor Degree' => 'Bachelor Degree',
                        'Master Degree' => 'Master Degree',
                        'PHD' => 'PHD',
                    ]),
                    Select::make('field_of_education')
                    ->options([
                        'Secondry School' => 'Secondry School',
                        'Computer Scinces' => 'Computer Scinces',
                        'Political Scinces' => 'Political Scinces',
                        'Ecommerce' => 'Ecommerce',
                        'English Litretured' => 'English Litretured',
                        'Envirmante Science' => 'Envirmante Science',
                        'Civil Engeinering' => 'Civil Engeinering',
                        'Electoraction Engeinering' => 'Electoraction Engeinering',
                    ]),
                    TextInput::make('phone'),
                    FileUpload::make('img_url')->directory('Teacher_images'),
                    Textarea::make('bio'),
                    ])
                ])->submitAction(new HtmlString('<button type="submite">Save</button>'))
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $data = $this->form->getState();
        DB::transaction(function () use ($data){
           $user = User::create([
                'name'=> $data['name'],
                'email'=> $data['email'],
                'password'=> $data['password'],
                'role'=> 'teacher',
            ]);
            $user->teacher()->create([
            'last_name'=> $data['last_name'],
                'phone'=> $data['phone'],
                'img_url'=> $data['img_url'],
                'bio'=> $data['bio'],
                'degree'=> $data['degree'],
                'field_of_education'=> $data['field_of_education'],
            ]);
            return redirect()->route('teachers.index');
        });

        
    }

    public function render(): View
    {
        return view('livewire.teacher.create-teacher');
    }
}

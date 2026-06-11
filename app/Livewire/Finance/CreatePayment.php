<?php

namespace App\Livewire\Finance;

use App\Models\Sinf;
use App\Models\User;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
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
                    Step::make('User')->icon(Heroicon::User)->description('Information aboute  new user')->columns(2)
                    ->schema([
                    TextInput::make('name')->required(),
                    TextInput::make('email')->required()->type('email'),
                    TextInput::make('password')->type('password')->required(),
                    TextInput::make('role')->default('Student'),
                    ]),
                    Step::make('Student')->description('Information aboute new Student')->completedIcon(Heroicon::Check)->icon(Heroicon::AcademicCap)
                    ->schema([
                    TextInput::make('last_name')->required(),
                    TextInput::make('phone')->required(),
                    TextInput::make('tazkira'),
                    FileUpload::make('img_url')->directory('student_images'),
                    ]),
                     Step::make('Payment')->description('Information aboute Payment')->completedIcon(Heroicon::Check)->icon(Heroicon::Banknotes)
                    ->schema([
                    TextInput::make('amount')->type('number'),
                    Select::make('sinf_id')->label('Sinf')->options(Sinf::query()->pluck('title','id'))->searchable()
                    
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
            ]);
            $student = $user->student()->create([
             'last_name'=> $data['last_name'],
                'phone'=> $data['phone'],
                'img_url'=> $data['img_url'],
                'tazkira'=> $data['tazkira'],
            ]);
            $student->payment()->create([
                "amount"=> $data['amount'],
                "sinf_id"=> $data['sinf_id'],
            ]);
            return redirect()->route('students.index');
        });
        //
    }

    public function render(): View
    {
        return view('livewire.finance.create-payment');
    }
}

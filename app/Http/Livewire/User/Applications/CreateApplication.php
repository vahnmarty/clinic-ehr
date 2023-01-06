<?php

namespace App\Http\Livewire\User\Applications;

use Faker\Factory;
use App\Models\User;
use App\Models\Tenant;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;


class CreateApplication extends Component implements HasForms
{
    use InteractsWithForms;
    
    public $name, $company, $address, $state, $zip, $city;

    public function render()
    {
        return view('livewire.user.applications.create-application')->layout('layouts.user');
    }

    public function mount(): void
    {
        $faker = Factory::create();
        
        $this->form->fill([
            'name' => $faker->domainWord . '-' . $faker->domainWord,
        ]);
    }

    protected function getFormSchema(): array 
    {
        return [
            TextInput::make('name')->label('App Name')->required(),
            TextInput::make('company')->label('Company Name')->required(),
            TextInput::make('address1')->label('Street Address')->required(),
            TextInput::make('state')->required(),
            TextInput::make('city')->required(),
            TextInput::make('zip_code')->required(),
        ];
    } 

    public function submit()
    {
        $data = $this->validate();

        $tenant = Tenant::create([
                'id' => $data['name'],
                'user_id' => auth()->id()
            ]);

        $tenant->company = $data['company'];
        $tenant->address1 = $data['address1'];
        $tenant->state = $data['state'];
        $tenant->city = $data['city'];
        $tenant->zip_code = $data['zip_code'];
        $tenant->save();

        $tenant->domains()->firstOrCreate([
            'domain' => strtolower($data['name']) . '.' . env('APP_DOMAIN')
        ]);

        $tenant->run(function () {
            $this->createRoles();
            $this->createAdmin();
        });

        return redirect('dashboard');
    }

    public function createRoles()
    {
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $provider = Role::firstOrCreate(['name' => 'provider']);
        $support = Role::firstOrCreate(['name' => 'support']);
    }

    public function createAdmin()
    {
        $auth = Auth::user();

        $user = User::firstOrNew(['email' =>  $auth->email]);
        $user->name = "Admin";
        $user->password = $auth->password;
        $user->save();

        $user->assignRole('admin');

    }


}

<?php

namespace App\Http\Livewire\Patient;

use App\Models\Patient;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePatient extends Component
{

    use WithFileUploads;
    
    public $first_name, $last_name, $email, $date_of_birth;

    public $avatar;

    protected $rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'nullable|email',
        'date_of_birth' => 'required|date',
    ];

    public function render()
    {
        return view('livewire.patient.create-patient');
    }

    public function store()
    {
        $data = $this->validate();
        //$data['avatar'] = $this->saveAvatar(); Can't access storage/public

        Patient::create($data);

        $this->dispatchBrowserEvent('closemodal-create');

        $this->emitUp('refreshParent');
    }

    public function saveAvatar()
    {
        $this->validate([
            'avatar' => 'nullable|image|max:1024'
        ]);

        return $this->avatar->store('avatars', 'public');
    }
}

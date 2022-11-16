<?php

namespace App\Http\Livewire\Patient;

use Livewire\Component;
use App\Models\Patient;

class CreatePatient extends Component
{
    public $first_name, $last_name, $email, $date_of_birth;

    protected $rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'nullable|email',
        'date_of_birth' => 'required|date'
    ];

    public function render()
    {
        return view('livewire.patient.create-patient');
    }

    public function store()
    {
        $data = $this->validate();

        Patient::create($data);

        $this->dispatchBrowserEvent('closemodal-create');

        $this->emitUp('refreshParent');
    }
}

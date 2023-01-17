<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Application;

class DoctorDashboard extends Component
{
    public $appointments = [];

    public function render()
    {
        return view('livewire.doctor-dashboard');
    }

    public function mount()
    {
        $this->appointments = Application::get()->all();
    }
}

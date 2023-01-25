<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Application;

class DoctorDashboard extends Component
{
    public $appointments = [];

    public $date;

    protected $queryString = ['date'];

    public function render()
    {
        $json = collect();

        $schedules = Application::orderBy('appointment_date', 'asc')->get();

        foreach($schedules as $app)
        {
            $json->push([
                'title' => $app->patient->patient_number,
                'start' => $app->appointment_date?->toIso8601String()
            ]);
        }

        $events = $json;

        return view('livewire.doctor-dashboard', compact('events'));
    }

    public function mount()
    {
        $this->date = date('Y-m-d');
        $this->appointments = Application::orderBy('appointment_date', 'asc')->whereDate('appointment_date', $this->date)->get();//->all();
    }
}

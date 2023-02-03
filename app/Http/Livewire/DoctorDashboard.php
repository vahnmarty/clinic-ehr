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
                'start' => $app->appointment_date?->format('Y-m-d H:i:s')
            ]);
        }

        $events = $json;

        return view('livewire.doctor-dashboard', compact('events'));
    }

    public function mount()
    {
        if(!$this->date){
            $this->date = date('Y-m-d');
        }
        
        $this->appointments = Application::orderBy('appointment_date', 'asc')->whereDate('appointment_date', $this->date)->get();//->all();
    }

    public function setDate($date)
    {
        $this->date = $date;
    }
}

<?php

namespace App\Http\Livewire\Station;

use Livewire\Component;
use App\Models\Application;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Auth;

class CheckoutPatient extends Component
{
    use LivewireAlert;
    
    public $patient_id;

    protected $listeners = [
        'confirmed'
    ];

    public function render()
    {
        return view('livewire.station.checkout-patient');
    }

    public function mount($patientId)
    {
        $this->patient_id = $patientId;
    }

    public function checkout()
    {
        $this->alert('question', 'Confirm Checkout?', [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Yes, Confirm',
            'onConfirmed' => 'confirmed' 
        ]);
    }

    public function confirmed()
    {
        $app = Application::where('patient_id', $this->patient_id)->latest()->first();

        $app->check_out_at = now();
        $app->check_out_user_id = Auth::id();
        $app->save();
        
        $this->alert('success', 'Patient successfully checked out');

        return redirect()->route('patient.show', $this->patient_id);
    }
}

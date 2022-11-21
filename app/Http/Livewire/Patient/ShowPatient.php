<?php

namespace App\Http\Livewire\Patient;

use App\Models\Patient;
use Livewire\Component;
use App\Models\MedicalProblem;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ShowPatient extends Component
{
    use LivewireAlert;
    
    public $patient_id;

    public $medical_problem, $medical_problem_id;

    protected $listeners = ['confirmDeleteMedicalProblem' => 'destroyMedicalProblem'];

    public function render()
    {
        $patient = Patient::with('medicalProblems')->findOrFail($this->patient_id);

        return view('livewire.patient.show-patient', compact('patient'));
    }

    public function mount($id)
    {
        $this->patient_id = $id;
    }

    public function addMedicalProblem()
    {
        $patient = Patient::find($this->patient_id);

        $patient->medicalProblems()->create([
            'name' => $this->medical_problem
        ]);

        $this->reset('medical_problem');

        $this->alert('success', 'Added medical problem!');
    }

    public function promptDeleteMedicalProblem($medicalProblemId)
    {
        $this->medical_problem_id = $medicalProblemId;

        $this->alert('question', 'Are you sure you want to delete this item?', [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Yes, confirm delete',
            'onConfirmed' => 'confirmDeleteMedicalProblem',
        ]);
    }

    public function destroyMedicalProblem()
    {
        MedicalProblem::destroy($this->medical_problem_id);

        $this->reset('medical_problem_id');

        $this->alert('success', 'Deleted medical problem!');
    }
    
}

<?php

namespace App\Http\Livewire\Patient;

use App\Models\Patient;
use Livewire\Component;
use App\Models\Medication;
use App\Models\MedicalProblem;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ShowPatient extends Component
{
    use LivewireAlert;
    
    public $patient_id;

    public $medical_problem, $medical_problem_id;

    public $medication, $medication_id;

    protected $listeners = [
        'confirmDeleteMedicalProblem' => 'destroyMedicalProblem', 
        'confirmDeleteMedication' => 'destroyMedication',
        'confirmDeleteGuardian' => 'destroyGuardian',
        'refreshParent' => '$refresh'
    ];

    public function render()
    {
        $patient = Patient::with('medicalProblems', 'medications', 'prenatal')->findOrFail($this->patient_id);

        return view('livewire.patient.show-patient', compact('patient'));
    }

    public function mount($id)
    {
        $this->patient_id = $id;
    }

    // Medical Problems

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

    // Current Medication

    public function addMedication()
    {
        $patient = Patient::find($this->patient_id);

        $patient->medications()->create([
            'name' => $this->medication
        ]);

        $this->reset('medication');

        $this->alert('success', 'Added current medication!');
    }

    public function promptDeleteMedication($medicationId)
    {
        $this->medication_id = $medicationId;

        $this->alert('question', 'Are you sure you want to delete this item?', [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Yes, confirm delete',
            'onConfirmed' => 'confirmDeleteMedication',
        ]);
    }

    public function destroyMedication()
    {
        Medication::destroy($this->medication_id);

        $this->reset('medication_id');

        $this->alert('success', 'Deleted current medication!');
    }
    
}

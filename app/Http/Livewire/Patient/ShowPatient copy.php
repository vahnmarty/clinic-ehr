<?php

namespace App\Http\Livewire\Patient;

use App\Models\Allergy;
use App\Models\Patient;
use Livewire\Component;
use App\Models\Medication;
use App\Models\Application;
use App\Models\MedicalProblem;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ShowPatient extends Component
{
    use LivewireAlert;
    
    public $patient_id;

    public $medical_problem, $medical_problem_id;

    public $medication, $medication_id;

    public $allergy, $allergy_id;

    public $application;

    protected $listeners = [
        'confirmDeleteMedicalProblem' => 'destroyMedicalProblem', 
        'confirmDeleteMedication' => 'destroyMedication',
        'confirmDeleteGuardian' => 'destroyGuardian',
        'confirmDeleteAllergy' => 'destroyAllergy',
        'refreshParent' => '$refresh'
    ];

    public function render()
    {
        $patient = Patient::with('medicalProblems', 'medications', 'prenatal', 'allergies')->findOrFail($this->patient_id);

        return view('livewire.patient.show-patient', compact('patient'));
    }

    public function mount($id)
    {
        $this->patient_id = $id;

        $this->app = Application::where('patient_id', $id)->latest()->first();
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

    public function updateMedicalProblem($medicalProblemId, $newName)
    {
        $medicalProblem = MedicalProblem::find($medicalProblemId);
        $medicalProblem->name = $newName;
        $medicalProblem->save();

        $this->alert('success', 'Updated successfully!');

        $this->dispatchBrowserEvent('close-edit');
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

    public function updateMedication($medicationId, $newName)
    {
        $medication = Medication::find($medicationId);
        $medication->name = $newName;
        $medication->save();

        $this->alert('success', 'Updated successfully!');

        $this->dispatchBrowserEvent('close-edit');
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


    // Allergies

    public function addAllergy()
    {
        $patient = Patient::find($this->patient_id);

        $patient->allergies()->create([
            'name' => $this->allergy
        ]);

        $this->reset('allergy');

        $this->alert('success', 'Added allergy!');
    }

    public function updateAllergy($medicationId, $newName)
    {
        $medication = Medication::find($medicationId);
        $medication->name = $newName;
        $medication->save();

        $this->alert('success', 'Updated successfully!');

        $this->dispatchBrowserEvent('close-edit');
    }

    public function promptDeleteAllergy($allergyId)
    {
        $this->allergy_id = $allergyId;

        $this->alert('question', 'Are you sure you want to delete this allergy item?', [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Yes, confirm delete',
            'onConfirmed' => 'confirmDeleteAllergy',
        ]);
    }

    public function destroyAllergy()
    {
        Allergy::destroy($this->allergy_id);

        $this->reset('allergy_id');

        $this->alert('success', 'Deleted allergy!');
    }
    
}

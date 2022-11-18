<?php

namespace App\Http\Livewire;

use App\Models\Patient;
use Livewire\Component;
use App\Services\AnthropometricCalculator;

class InputVitalSign extends Component
{
    public $weight, $height, $head_circumference, $tricep_skinfold, $subscapular_skinfold, $edema, $measured_recumbent, $muac;

    public $sex, $age, $age_in_days, $bmi, $date_of_birth, $date_of_vist;

    public $results = [];

    public Patient $patient;

    public function render()
    {
        $this->calculator();

        return view('livewire.input-vital-sign');
    }

    public function mount($patientId)
    {
        $this->patient_id = $patientId;
        $this->createFaker();
        $this->getPatient($patientId);
    }

    public function getPatient($id)
    {
        $this->patient = Patient::find($id);
        $this->date_of_birth = $this->patient->date_of_birth;
    }

    public function createFaker()
    {
        $this->weight = 9; 
        $this->height = 73;
        $this->head_circumference = 45;
        $this->edema = 0;
        $this->measured_recumbent = 1;
        $this->sex = 'male';
        $this->date_of_birth = '2021-11-17';
        $this->date_of_visit = date('Y-m-d');
        $this->muac = 15;
        $this->tricep_skinfold = 8;
        $this->subscapular_skinfold = 7;
    }

    public function calculator()
    {
        $calculator = new AnthropometricCalculator;

        // Setters
        $calculator->setWeight($this->weight);
        $calculator->setHeight($this->height);
        $calculator->setSex($this->sex);
        $calculator->setHeadCircumference($this->head_circumference);
        $calculator->setTricepSkinfold($this->tricep_skinfold);
        $calculator->setEdema($this->edema);
        $calculator->setMeasuredRecumbent($this->measured_recumbent);
        $calculator->setDateOfBirth($this->date_of_birth);
        $calculator->setDateOfVisit($this->date_of_visit);
        $calculator->setMuac($this->muac);
        $calculator->setSubscapularSkinfold($this->subscapular_skinfold);


        // Props
        $this->age_in_days = $calculator->getAge();
        $this->bmi = $calculator->getBMI();


        // Results
        $results = $calculator->getResults();
        
        $chunks = collect($results)->chunk(4);

        $this->results = $chunks;
    }


}

<?php

namespace App\Http\Livewire;

use App\Models\Patient;
use Livewire\Component;
use App\Models\VitalSign;
use App\Services\AnthropometricCalculator;

class InputVitalSign extends Component
{
    public $weight, $height, $head_circumference, $tricep_skinfold, $subscapular_skinfold, $edema, $measured_recumbent, $muac;

    public $sex, $age, $age_in_days, $bmi, $date_of_birth, $date_of_vist;

    public $results = [], $history = [];

    public Patient $patient;

    public function render()
    {
        return view('livewire.input-vital-sign');
    }

    public function mount($patientId)
    {
        $this->patient_id = $patientId;
        $this->createFaker();
        $this->getPatient($patientId);
        $this->getHistory();
        $this->calculator();
    }

    public function getHistory()
    {
        $this->history = VitalSign::where('patient_id', $this->patient_id)->latest()->get();
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
        $this->results = $calculator->getResults();
    
    }
    

    public function save()
    {
        $record = new VitalSign;

        // Input
        $record->patient_id = $this->patient_id;
        $record->date_of_visit = $this->date_of_visit;
        $record->age_in_days = $this->age_in_days;
        $record->bmi = $this->bmi;
        $record->height = $this->height;
        $record->weight = $this->weight;
        $record->head_circumference = $this->head_circumference;
        $record->muac = $this->muac;
        $record->tricep_skinfold = $this->tricep_skinfold;
        $record->subscapular_skinfold = $this->subscapular_skinfold;
        $record->edema = $this->edema;
        $record->measured_recumbent = $this->measured_recumbent;

        // Output
        foreach($this->results as $label =>  $result)
        {
            $record->$label = $result['value'];
        }

        $record->save();


        $this->getHistory();
    }


}

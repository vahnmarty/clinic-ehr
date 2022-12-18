<?php

namespace App\Http\Livewire\Station;

use App\Models\Patient;
use Livewire\Component;
use App\Models\VitalSign;
use App\Models\Application;
use App\Services\AnthropometricCalculator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Http\Livewire\Station\SearchPatientTrait;

class PatientVitalSign extends Component
{
    use SearchPatientTrait;
    use LivewireAlert;

    public $weight, $height, $head_circumference, $tricep_skinfold, $subscapular_skinfold, $edema, $measured_recumbent, $muac;

    public $sex, $age, $age_in_days, $bmi, $date_of_birth, $date_of_visit;

    public $results = [], $history = [];

    protected $listeners = ['selectPatient'];

    protected $rules = [
        'weight' => 'required',
        'height' => 'required',
        'head_circumference' => 'required',
        'tricep_skinfold' => 'required',
        'subscapular_skinfold' => 'required',
        'edema' => 'required',
        'measured_recumbent' => 'required',
        'muac' => 'required',
        'sex' => 'required',
        'date_of_birth' => 'required',
        'date_of_visit' => 'required',
    ];

    public $patientId;
    protected $queryString = ['patientId'];
    
    public function render()
    {
        return view('livewire.station.patient-vital-sign');
    }

    public function mount()
    {
        if($this->patientId){
            $this->selectPatient($this->patientId);
        }
    }

    public function getHistory()
    {
        $this->history = VitalSign::where('patient_id', $this->patient_id)->latest()->get();
    }

    public function fillForm()
    {
        $this->weight = $this->patient->weight; 
        $this->height = $this->patient->height;
        $this->head_circumference = 0;
        $this->edema = 0;
        $this->measured_recumbent = 0;
        $this->sex = $this->patient->sex;
        $this->date_of_birth = $this->patient->date_of_birth;;
        $this->date_of_visit = date('Y-m-d');
        $this->muac = 0;
        $this->tricep_skinfold = 0;
        $this->subscapular_skinfold = 0;

        $this->getHistory();
    }

    public function calculator()
    {
        $data = $this->validate();

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
        $latestApp = Application::where('patient_id', $this->patient_id)->latest()->first();

        // Input
        $record->application_id = $latestApp->id;
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

        $latestApp->vital_sign_finished_at = now();
        $latestApp->vital_sign_user_id   = auth()->id();
        $latestApp->save();


        $this->getHistory();

        $this->alert('success',  __("Entry added!"));
    }
}

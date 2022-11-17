<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Services\AnthropometricCalculator;

class InputVitalSign extends Component
{
    public $weight, $height, $head_circumference, $tricep_skinfold, $subscapular_skinfold, $edema, $measured_recumbent, $muac;

    public $sex, $age, $date_of_birth, $date_of_vist;

    public $results = [];

    public function render()
    {
        $this->calculator();

        return view('livewire.input-vital-sign');
    }

    public function mount()
    {
        $this->createFaker();
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


        $results = $calculator->getResults();
        
        $chunks = collect($results)->chunk(4);

        $this->results = $chunks;
    }


}

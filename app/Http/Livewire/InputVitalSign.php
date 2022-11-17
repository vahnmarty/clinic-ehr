<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Services\AnthropometricCalculator;

class InputVitalSign extends Component
{
    public $weight, $height, $head_circumference, $tricep_circumference, $edema, $measured_recumbent;

    public $sex;

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
    }

    public function calculator()
    {
        $calculator = new AnthropometricCalculator;

        $calculator->setWeight($this->weight);
        $calculator->setHeight($this->height);
        $calculator->setSex($this->sex);
        $calculator->setHeadCircumference($this->head_circumference);
        $calculator->setTricepCircumference($this->tricep_circumference);
        $calculator->setEdema($this->edema);
        $calculator->setMeasuredRecumbent($this->measured_recumbent);


        $this->results = $calculator->getResults();
        
    }


}

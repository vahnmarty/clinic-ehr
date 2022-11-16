<?php

namespace App\Http\Livewire;

use Livewire\Component;

class InputVitalSign extends Component
{
    public $weight, $height, $head_circumference, $tricep_circumference, $edema, $measured_recumbent;

    public $sex;

    public function render()
    {
        return view('livewire.input-vital-sign');
    }

    public function mount()
    {
        $this->createFaker();

        $this->getWeightForLength();
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

    public function getWeightForLength()
    {
        $height = $this->height;
        $weight = $this->weight;
        $sex = $this->sex;

        // If sex, weight or height are undefined, return -
        if (!$this->sex || !$this->weight || !$this->height) {
            return '-';
        }

        // If patient has oedema, return -
        if ($this->edema) {
            return '-';
        }

         // If the selected height is outside the specifications provided by WHO, return -
        if ($this->height < 45 || $this->height > 110) {
            return '-';
        }

        // Get the two closest applicable LMS value sets
        $lowheight = floor($height * 10) / 10;
        $maxheight = round(($lowheight + 0.1) * 10) / 10;

        // Collect the two LMS values for either male or female
        $lowlms = $this->getDataset('wfl_boys',$lowheight);
        $highlms = $this->getDataset('wfl_boys',$maxheight);

        // if (this.props['S']ex === 'female') {
        // lowlms = datasets.wfl_girls[lowheight];
        // highlms = datasets.wfl_girls[maxheight];
        // }

        // Get the number of steps.
        // Example:
        //  given height: 55.32, low LMS = 55.3
        // (55.32 - 55.3) * 100 = 2
        $steps = round(($height - $lowheight) * 100);


        // Interpolate value of numbers between given WHO LMS table values
        // Example:
        //  L at 55.3 = 4.6319, L at 53.4 = 4.6605, given height = 55.32
        //  4.6319 + ((4.6605 - 4.6319) / 10) * 2 = 4.63762
        $var_L = $lowlms['L'] + ((($highlms['L'] - $lowlms['L']) / 10) * $steps);
        $var_M = $lowlms['M'] + ((($highlms['M'] - $lowlms['M']) / 10) * $steps);
        $var_S = $lowlms['S'] + ((($highlms['S'] - $lowlms['S']) / 10) * $steps);

        $value = $this->calcZScore($weight, $var_L, $var_M, $var_S);

        dd($value);
    }

    public function getDataset($file, $value)
    {
        $data = global_asset('data/Centile_Tables/' . $file . '.json');
        $json = json_decode(file_get_contents($data), true);
        return $json[$value];
    }

    private function calcZscore ($y, $L, $M, $S) 
    {
        $zscore = (pow(($y / $M), $L) - 1) / ($S * $L);
    
        if ($zscore < -3) {
          $sd3neg = $this.getSDX(-3, $L, $M, $S);
          $sd2neg = $this.getSDX(-2, $L, $M, $S);
          return (-3) + (($y - $sd3neg) / ($sd2neg - $sd3neg));
        }
    
        if ($zscore > 3) {
          $sd3pos = $this.getSDX(3, $L, $M, $S);
          $sd2pos = $this.getSDX(2, $L, $M, $S);
          return 3 + (($y - $sd3pos) / ($sd3pos - $sd2pos));
        }
    
        return $zscore;
      }

    private function getSDX ($num, $L, $M, $S){
        return $M * pow((1 + $L * $S * $num), (1 / $L));
    }
}

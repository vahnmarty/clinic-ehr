<?php

namespace App\Services;

class AnthropometricCalculator{

    private $weight, $height, $head_circumference, $tricep_circumference, $edema, $measured_recumbent;

    private $sex;

    public function __construct()
    {

    }

    // Setters

    public function setWeight($value)
    {
        $this->weight = $value;
    }

    public function setHeight($value)
    {
        $this->height = $value;
    }

    public function setHeadCircumference($value)
    {
        $this->head_circumference = $value;
    }

    public function setTricepCircumference($value)
    {
        $this->tricep_circumference = $value;
    }

    public function setEdema($value)
    {
        $this->edema = $value;
    }

    public function setMeasuredRecumbent($value)
    {
        $this->measured_recumbent = $value;
    }

    public function setSex($value)
    {
        $this->sex = $value;
    }

    // Getters

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
        $centile = $this->getCentile($value);

        return [
            'value' => round($value, 2),
            'centile' => $centile
        ];
    }

    private function getDataset($file, $value)
    {
        $data = global_asset('data/Centile_Tables/' . $file . '.json');
        $json = json_decode(file_get_contents($data), true);
        return $json[$value];
    }


    // Functions

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

    private function getCentile($zscore)
    {
        $absoluteZscore = abs($zscore);

        if ($zscore === '-' || $absoluteZscore > 3) {
        // disable percent
        return 0;
        }

        $k = 1 / (1 + 0.2316419 * $absoluteZscore);
        $z = 1 / sqrt(2 * M_PI) * exp(-pow($absoluteZscore, 2) / 2);
        $a1 = 0.319381530;
        $a2 = -0.356563782;
        $a3 = 1.781477937;
        $a4 = -1.821255978;
        $a5 = 1.330274429;

        $centile = 1 - $z * ($a1 * $k + $a2 * pow($k, 2) + $a3 * pow($k, 3) + $a4 * pow($k, 4) + $a5 * pow($k, 5));

        if ($zscore > 0) {
        return round(($centile * 100) * 100) / 100;
        }

        return round((100 - $centile * 100) * 100) / 100;
    }


    public function getResults()
    {
        return [
            'weight_for_length' => $this->getWeightForLength()
        ];
    }

}
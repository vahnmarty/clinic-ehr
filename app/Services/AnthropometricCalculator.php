<?php

namespace App\Services;

use Carbon\Carbon;

class AnthropometricCalculator{

    private $weight, $height, $head_circumference, $tricep_skinfold, $subscapular_skinfold, $edema, $measured_recumbent, $muac;

    private $sex, $age;

    private $dateOfVisit, $dateOfBirth;

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

    public function setTricepSkinfold($value)
    {
        $this->tricep_skinfold = $value;
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

    public function setDateOfVisit($value)
    {
        $this->dateOfVisit = $value;
    }

    public function setDateOfBirth($value)
    {
        $this->dateOfBirth = $value;
    }

    public function setMuac($value)
    {
        $this->muac = $value;
    }

    public function setSubscapularSkinfold($value)
    {
        $this->subscapular_skinfold = $value;
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

        if ($this->sex === 'female') {
        $lowlms = $this->getDataset('wfl_girls',$lowheight);
        $highlms = $this->getDataset('wfl_girls',$maxheight);
        }

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
        $dataset_sd = $this->sex == 'female' ? 'wfl_girls_sd' : 'wfl_boys_sd';

        return [
            'value' => $value,
            'centile' => $centile,
            'chart' => [
                'title' => 'Weight for Length',
                'x' => 'Weight (kg)',
                'y' => 'Height (cm)',
                'dataset' => $dataset_sd
            ]
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
          $sd3neg = $this->getSDX(-3, $L, $M, $S);
          $sd2neg = $this->getSDX(-2, $L, $M, $S);
          return (-3) + (($y - $sd3neg) / ($sd2neg - $sd3neg));
        }
    
        if ($zscore > 3) {
          $sd3pos = $this->getSDX(3, $L, $M, $S);
          $sd2pos = $this->getSDX(2, $L, $M, $S);
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

    public function getAge()
    {
        // Age in Days.
        return Carbon::now()->diffInDays($this->dateOfBirth);
        //return ($this->dateOfVisit - $this->dateOfBirth) / 1000 / 60 / 60 / 24;
    }

    public function getBMI()
    {
        $weight = $this->weight;
        $height = $this->height;

        if (!$weight || !$height || $this->edema) {
            return '-';
        }
      
        return round($weight / pow($height / 100, 2) * 100) / 100;
    }


    public function getWeightForAge()
    {
        $sex = $this->sex;
        $weight = $this->weight;
        $age = $this->getAge();

        // If patient has oedema, return -
        if ($this->edema) {
        return '-';
        }

        // Get LMS values for the given parameters
        $LMS = $this->getLMS($sex, $age, 'wfa_boys', 'wfa_girls');


        // If getLMS() returned '-', data could not be retrieved
        if ($LMS === '-') {
        return $LMS;
        }

        // Calculate the zscore based on the lms values and the weight
        $wfa = $this->calcZscore($weight, $LMS['L'], $LMS['M'], $LMS['S']);

        $dataset_sd = $this->sex == 'female' ? 'wfa_girls_sd' : 'wfa_boys_sd';

        return [
            'value' => $wfa,
            'centile' => $this->getCentile($wfa),
            'chart' => [
                'title' => 'Weight for Age',
                'x' => 'Age (months)',
                'y' => 'Weight (kg)',
                'dataset' => $dataset_sd
            ]
        ];
    }

    private function getLMS($sex = null, $age = '-', $dataset_boys, $dataset_girls)
    {
        if (!$sex || $age == '-') {
            return '-';
          }
      
          // Round the age to the nearest integer
          $age = round($age);
      
          // Check if age exceeds data limit
          if ($age > 1856) {
            return '-';
          }

      
          // Get LMS values from age based on sex
          if ($sex === 'female') {
            $LMS = $this->getDataset($dataset_girls,$age);
          }else{
            $LMS = $this->getDataset($dataset_boys,$age);
          }
      
          return $LMS;
    }

    public function getLengthForAge() 
    {
        $sex = $this->sex;
        $height = $this->height;
        $age = $this->getAge();
    
        // Get LMS values for the given parameters
        $LMS = $this->getLMS($sex, $age, 'lhfa_boys', 'lhfa_girls');
    
        // If getLMS() returned '-', data could not be retrieved
        if ($LMS === '-') {
          return $LMS;
        }
    
    
        // Calculate the zscore based on the lms values and the height
        $lfa = $this->calcZscore($height, $LMS['L'], $LMS['M'], $LMS['S']);

        $dataset_sd = $this->sex == 'female' ? 'lhfa_girls_sd' : 'lhfa_boys_sd';
    
        return [
            'value' => $lfa,
            'centile' => $this->getCentile($lfa),
            'chart' => [
                'title' => 'Length for Age',
                'x' => 'Age (months)',
                'y' => 'Height (cm)',
                'dataset' => $dataset_sd
            ]
        ];
    }

    public function getBMIForAge(){
        $sex = $this->sex;
        $bmi = $this->getBMI();
        $age = $this->getAge();
    
        // If patient has oedema, return -
        if ($this->edema) {
          return '-';
        }
    
        // Get LMS values for the given parameters
        $LMS = $this->getLMS($sex, $age, 'bfa_boys', 'bfa_girls');
    
        // If getLMS() returned '-', data could not be retrieved
        if ($LMS === '-') {
          return $LMS;
        }
    
        // Calculate the zscore based on the lms values and the bmi
        $bfa = $this->calcZscore($bmi, $LMS['L'], $LMS['M'], $LMS['S']);

        $dataset_sd = $this->sex == 'female' ? 'bfa_girls_sd' : 'bfa_boys_sd';
    
        return [
            'value' => $bfa,
            'centile' => $this->getCentile($bfa),
            'chart' => [
                'title' => 'Weight for Age',
                'x' => 'Age (months)',
                'y' => 'BMI',
                'dataset' => $dataset_sd
            ]
        ];
    }

    public function getHCForAge() {
        $sex = $this->sex;
        $hc = $this->head_circumference;
        $age = $this->getAge();
    
        // Get LMS values for the given parameters
        $LMS = $this->getLMS($sex, $age, 'hcfa_boys', 'hcfa_girls');
    
        // If getLMS() returned '-', data could not be retrieved
        if ($LMS === '-') {
          return $LMS;
        }
    
        // Calculate the zscore based on the lms values and the bmi
        $hcfa = $this->calcZscore($hc, $LMS['L'], $LMS['M'], $LMS['S']);

        $dataset_sd = $this->sex == 'female' ? 'hcfa_girls_sd' : 'hcfa_boys_sd';
    
        return [
            'value' => $hcfa,
            'centile' => $this->getCentile($hcfa),
            'chart' => [
                'title' => 'Weight for Age',
                'x' => 'Age (months)',
                'y' => 'Head Circumference (cm)',
                'dataset' => $dataset_sd
            ]
        ];
    }

    public function getMUACForAge() {
        $sex = $this->sex;
        $muac = $this->muac;
        $age = $this->getAge();
    
        // Get LMS values for the given parameters
        $LMS = $this->getLMS($sex, $age, 'acfa_boys', 'acfa_girls');
    
        // If getLMS() returned '-', data could not be retrieved
        if ($LMS === '-') {
          return $LMS;
        }
    
        // Calculate the zscore based on the lms values and the bmi
        $acfa = $this->calcZscore($muac, $LMS['L'], $LMS['M'], $LMS['S']);
        $dataset_sd = $this->sex == 'female' ? 'acfa_girls_sd' : 'acfa_boys_sd';
    
        return [
            'value' => $acfa,
            'centile' => $this->getCentile($acfa),
            'chart' => [
                'title' => 'MUAC for Age',
                'x' => 'Age (months)',
                'y' => 'MUAC',
                'dataset' => $dataset_sd
            ]
        ];
    }

    public function getTSFForAge() {
        $sex = $this->sex;
        $ts = $this->tricep_skinfold;
        $age = $this->getAge();
    
        // Get LMS values for the given parameters
        $LMS = $this->getLMS($sex, $age, 'tsfa_boys', 'tsfa_girls');
    
        // If getLMS() returned '-', data could not be retrieved
        if ($LMS === '-') {
          return $LMS;
        }
    
        // Calculate the zscore based on the lms values and the bmi
        $tsfa = $this->calcZscore($ts, $LMS['L'], $LMS['M'], $LMS['S']);
        $dataset_sd = $this->sex == 'female' ? 'tsfa_girls_sd' : 'tsfa_boys_sd';
    
        return [
            'value' => $tsfa,
            'centile' => $this->getCentile($tsfa),
            'chart' => [
                'title' => 'TSF for Age',
                'x' => 'Age (months)',
                'y' => 'BMI',
                'dataset' => $dataset_sd
            ]
        ];
    }

    public function getSSFForAge() {
        $sex = $this->sex;
        $ss = $this->subscapular_skinfold;
        $age = $this->getAge();
        
        // No data exists for ages below 91 days
        if ($age < 91) {
            return '-';
        }

        // Get LMS values for the given parameters
        $LMS = $this->getLMS($sex, $age, 'ssfa_boys', 'ssfa_girls');
    
        
        // If getLMS() returned '-', data could not be retrieved
        if ($LMS === '-') {
          return $LMS;
        }
    
        // Calculate the zscore based on the lms values and the bmi
        $ssfa = $this->calcZscore($ss, $LMS['L'], $LMS['M'], $LMS['S']);
        $dataset_sd = $this->sex == 'female' ? 'ssfa_girls_sd' : 'ssfa_boys_sd';

    
        return [
            'value' => $ssfa,
            'centile' => $this->getCentile($ssfa),
            'chart' => [
                'title' => 'SSF for Age',
                'x' => 'Age (months)',
                'y' => 'Subscapular skinfold (cm)',
                'dataset' => $dataset_sd
            ]
        ];
    }


    // Results

    public function partialResults()
    {
        return [
            'weight_for_length' => $this->getWeightForLength(),
            'weight_for_age' => $this->getWeightForAge(),
            'length_for_age' => $this->getLengthForAge(),
            'bmi_for_age' => $this->getBMIForAge(),
            'hc_for_age' => $this->getHCForAge(),
            'muac_for_age' => $this->getMUACForAge(),
            'tsf_for_age' => $this->getTSFForAge(),
            'ssf_for_age' => $this->getSSFForAge(),
        ];
    }

    public function getResults()
    {
        return $this->formatResults();
    }

    public function formatResults()
    {
        $array = $this->partialResults();

        foreach($array as $key => $value)
        {
            if($value == '-'){
                $array[$key] = ['value' => 0, 'centile' => 0];
            }
        }

        return $array;
    }

}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchIntermittentHealthForm extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getFieldset1()
    {
        return [
            'has_cough' => 'Cough',
            'has_respiratory_distress' => 'Respiratory distress',
            'has_intercostal_retractions' => 'Intercostal retractions (sinking of ribs)',
            'has_fever' => 'Fever',
            'has_rapid_breathing' => 'Fast or rapid breathing?',
            'has_green_yellow_mucous' => 'Green or yellow mucous?',
            'has_hospitalized' => 'Hospitalized in the last 2 weeks',
        ];
    }

    public function getFieldset2()
    {
        return [
            'has_no_food_symptoms' => 'None',
            'has_reflux' => 'Reflux',
            'has_diarrhea_scraps' => 'Diarrhea (with food scraps)',
            'has_abdominal_pain' => 'Abdominal Pain',
            'has_rash' => 'Rash',
            'has_glossitis' => 'Glossitis',
            'has_difficulty_swallowing' => 'Difficulty Swallowing',
            'has_needed_steroid' => 'Has the baby needed to consume any antihistaminic or steroid?'
        ];
    }
}

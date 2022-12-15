<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchMaternalHealthForm extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getFieldset1()
    {
        return [
            'has_associated_pain' => 'Associated pain? ',
            'has_intermenstrual_bleeding' => 'Intermenstrual Bleeding?',
            'has_vasomor_symptoms' => 'Vasomor Symptoms',
            'has_hormone_therapy' => 'On hormone replacement therapy? ',
            'has_menopause' => 'Menopause?',
        ];
    }
}

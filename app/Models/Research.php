<?php

namespace App\Models;

use App\Enums\FormType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Research extends Model
{
    use HasFactory;

    protected $casts = [
        'form_type' => FormType::class
    ];

    protected $guarded = [];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function intermittent()
    {
        return $this->belongsTo(ResearchIntermittentHealthForm::class, 'intermittent_form_id');
    }

    public function maternal()
    {
        return $this->belongsTo(ResearchMaternalHealthForm::class, 'maternal_health_id');
    }

    public function parental()
    {
        return $this->belongsTo(ResearchParentalHistoryForm::class, 'parental_history_id');
    }
}

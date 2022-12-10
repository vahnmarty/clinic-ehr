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
}
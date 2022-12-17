<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['status'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function researches()
    {
        return $this->hasMany(Research::class);
    }

    public function getStatusAttribute()
    {
        if($this->pharmacy_order_finished_at){
            return 'PHARMACY ORDER';
        }

        if($this->clinic_encounter_finished_at){
            return 'CLINIC ENCOUNTER';
        }

        if($this->research_form_finished_at){
            return 'RESEARCH FORM';
        }

        if($this->vital_sign_finished_at){
            return 'VITAL SIGN';
        }

        if($this->patient_info_finished_at){
            return 'PATIENT INFO';
        }
    }
}

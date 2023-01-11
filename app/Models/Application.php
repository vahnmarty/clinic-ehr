<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['status'];

    protected $casts = [
        'check_in_at' => 'datetime',
        'patient_info_finished_at' => 'datetime',
        'vital_sign_finished_at' => 'datetime',
        'research_form_finished_at' => 'datetime',
        'clinic_encounter_finished_at' => 'datetime',
        'pharmacy_order_finished_at' => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    public function researches()
    {
        return $this->hasMany(Research::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUser($id = null)
    {
        return $id ?  User::find($id)?->name : '';
    }

    public function getCode()
    {
        $uuid = explode('-', $this->uuid);
        return $uuid[0];
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

    public function scopeFromStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}

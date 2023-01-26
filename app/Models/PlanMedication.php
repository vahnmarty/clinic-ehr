<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanMedication extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function generateOrderNumber()
    {
        return 'SW-' . date('ymd') . '-' . $this->id; 
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}

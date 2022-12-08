<?php

namespace App\Models;

use App\Enums\GuardianType;
use App\Enums\MaritalStatus;
use App\Enums\RacialIdentity;
use App\Enums\PrimaryLanguage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guardian extends Model
{
    use HasFactory;

    protected $casts = [
        'primary_language' => PrimaryLanguage::class,
        'racial_identity' => RacialIdentity::class,
        'marital_status' => MaritalStatus::class,
    ];

    protected $guarded = [];
}

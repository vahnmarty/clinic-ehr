<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccineList extends Model
{
    use HasFactory;

    protected $guarded = [];

    public  static function asSelectArray()
    {
        $options = [];
        foreach(self::get() as $select)
        {
            $options[$select->name] = $select->name;
        }

        return $options;
    }
}

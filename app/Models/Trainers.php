<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainers extends Model
{
    protected $fillable = [
        'specialties', 'hire_date', 'name', 'email', 'phone', 
        'date_of_birth', 'gender', 'building_number', 'city', 'street'
    ];

    public function sessions()
    {
        return $this->hasMany(TrainingSession ::class);
    }
}

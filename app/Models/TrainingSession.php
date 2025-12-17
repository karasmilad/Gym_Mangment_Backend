<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class TrainingSession  extends Model
{
    protected $table = "training_sessions";
    protected $fillable = [
        'description', 'capacity', 'start_date', 'end_date', 
        'trainer_id', 'category_id'
    ];

    public function trainer()
    {
        return $this->belongsTo(Trainers::class);
    }

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    public function bookings()
    {
        return $this->hasMany(Bookings::class);
    }
}

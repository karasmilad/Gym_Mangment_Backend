<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    protected $fillable = ['member_id', 'session_id', 'is_attended', 'booking_date'];
    public function member()
    {
        return $this->belongsTo(Members::class);
    }
    public function session()
    {
        return $this->belongsTo(TrainingSession ::class);
    }
}

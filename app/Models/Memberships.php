<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Memberships extends Model
{
        protected $fillable = ['member_id', 'plan_id', 'start_date', 'end_date'];
    public function member()
    {
        return $this->belongsTo(Members::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plans::class);
    }
}

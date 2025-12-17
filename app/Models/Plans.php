<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
    protected $fillable = ['name', 'description', 'duration_days', 'price', 'is_active'];
    public function memberships()
    {
        return $this->hasMany(Memberships::class);
    }
}

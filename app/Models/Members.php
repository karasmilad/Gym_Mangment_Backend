<?php
namespace App\Models;
use App\Enums\Gender;
use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
        protected $fillable = [
        'photo', 'height', 'weight', 'blood_type', 'note',
        'join_date', 'name', 'email', 'phone', 'date_of_birth',
        'gender', 'building_number', 'city', 'street'
    ];
        protected $casts = [
        'gender' => Gender::class,
    ];
    public function memberships()
    {
        return $this->hasMany(Memberships::class);
    }

    public function bookings()
    {
        return $this->hasMany(Bookings::class);
    }
}

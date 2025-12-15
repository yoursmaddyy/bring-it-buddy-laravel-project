<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class TravellerPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'from_location',
        'to_location',
        'travel_date',
        'available_space',
        'preference',
        'fee',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function requests()
    {
        return $this->hasMany(BuyerRequest::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class BuyerRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'traveller_post_id',
        'user_id',
        'item_name',
        'item_description',
        'item_weight',
        'offered_price',
        'status',
    ];

    // The Traveller Post this request belongs to
    public function travellerPost()
    {
        return $this->belongsTo(TravellerPost::class);
    }

    // The Buyer who made the request
    public function buyer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
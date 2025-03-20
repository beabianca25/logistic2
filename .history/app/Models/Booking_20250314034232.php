<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone_number',
        'email',
        'address',
        'service_type',
        'venue_name',
        'number_of_participants',
        'number_of_guests',
        'ceremony_venue',
        'reception_venue',
        'guest_count',
        'activities_preferred',
        'event_date',
        'seating_preference',
        'school_group_name',
        'destination',
        'number_of_students',
        'departure_date',
        'return_date',
        'passenger_count',
        'number_of_travelers',
        'accommodation_preference',
        'pickup_location',
        'dropoff_location',
        'number_of_seats',
        'price',
        'status',
        'payment_status',
        'start_date',
    ];
}

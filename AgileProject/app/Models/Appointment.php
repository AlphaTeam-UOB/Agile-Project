<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    // Specify the table if it's not the plural of the model name
    protected $table = 'appointments';

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'name',
        'email',
        'date',
        'time',
        'status', // example of other fields you may have
    ];

    // You can define relationships with other models here if needed
}

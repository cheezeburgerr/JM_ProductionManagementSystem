<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


    protected $fillable = [
        'team_name',
        'address',
        'contact_number',
        'due_date',
        'apparel',
        'jersey_options',
        'jersey_type',
        'neck_type',
        'short_type',
        'placket',
        'collar',
        'fabric',
        'userID',
        'artist'
    ];

    protected $dates = ['due_date'];


}

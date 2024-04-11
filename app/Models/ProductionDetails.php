<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionDetails extends Model
{
    use HasFactory;

    protected $primaryKey = "production_details_id";
    protected $fillable = [
        'order_id',
        'artist_id',
        'printer_id',
        'status',
        'note'
    ];
}

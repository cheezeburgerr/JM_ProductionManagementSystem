<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    public function options() {
        return $this->belongsToMany(ProductOption::class, 'products_options_join')->withPivot('product_option_type');
    }
}

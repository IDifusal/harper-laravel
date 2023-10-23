<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    public function deliveryMethods()
    {
        return $this->belongsToMany(DeliveryMethod::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Property;

class FavoriteProperty extends Model
{
    use HasFactory;

    public function property(){
        return $this->hasOne(Property::class, 'id', 'property_id');
    }
}

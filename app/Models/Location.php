<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory ;

    protected $table = 'locations';
    
    protected $guarded = [];

    protected $casts = [
        'property_id', 'state','city' ,'area','street',
    ];
    

 
}

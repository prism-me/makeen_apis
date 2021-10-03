<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Mentor extends Eloquent
{
    use HasFactory;
    
    protected $table = 'mentors';

    protected $primaryKey = '_id';

    protected $guarded = [];

    public function getRouteKeyName(){

        return 'route';
    }
}

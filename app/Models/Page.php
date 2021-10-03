<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Page extends Eloquent
{   
    use HasFactory;

    protected $table = 'pages';

    protected $primaryKey = '_id';

    protected $guarded = [];

    public function getRouteKeyName(){

        return 'slug';
    }
}

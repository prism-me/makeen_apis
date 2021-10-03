<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Upload extends Eloquent
{
    use HasFactory;
    
    protected $table = 'uploads';

    protected $primaryKey = '_id';

    protected $guarded = [];


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class General extends Eloquent
{
    use HasFactory;

    protected $table = 'general';

    protected $primaryKey = '_id';

    protected $guarded = [];

}

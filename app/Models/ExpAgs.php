<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class ExpAgs extends Eloquent
{
    use HasFactory;

    protected $table = 'exp_ags';

    protected $primaryKey = '_id';

    protected $guarded = [];
}

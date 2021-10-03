<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Section extends Eloquent
{
    use HasFactory;

    protected $table = 'sections';

    protected $primaryKey = '_id';

    protected $guarded = [];
}

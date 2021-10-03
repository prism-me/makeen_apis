<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class studentCare extends Eloquent
{
    use HasFactory;

    protected $table = 'student_cares';

    protected $primaryKey = '_id';

    protected $guarded = [];


}

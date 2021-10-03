<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Todo extends Eloquent
{
    use HasFactory;

    protected $table = 'todos';

    protected $primaryKey = '_id';

    protected $guarded = [];
}

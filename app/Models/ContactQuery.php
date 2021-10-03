<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class ContactQuery extends Eloquent
{
    use HasFactory;

    protected $table = 'contact_queries';

    protected $primaryKey = '_id';

    protected $guarded = [];


}

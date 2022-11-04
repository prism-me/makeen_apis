<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoreAbout extends Model
{
    use HasFactory;
    protected $table = 'more_abouts';

    protected $primaryKey = 'id';

    protected $guarded = [];
}

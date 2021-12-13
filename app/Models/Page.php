<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{   
    use HasFactory;

    protected $table = 'pages';

    protected $primaryKey = 'id';

    protected $guarded = [];

    public function getRouteKeyName(){

        return 'slug';
    }

    protected $casts = [
        
        // 'description' => 'array',
        'meta_details' => 'array'
        
        ];

        
}

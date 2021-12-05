<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory ;

    protected $table = 'properties';
    
    protected $guarded = [];

    public function getRouteKeyName(){

        return 'slug';
    }

    protected $casts = [
        'gallery_images' => 'array',
        'floor_plan_images' => 'array',
        'video_images' => 'array',
        'images_360' => 'array',
        'amenities' => 'array',
        'meta_details' => 'array',
    ];

    public function location(){
        return $this->belongsTo(Location::class);
    }

    public function building(){
        return $this->belongsTo(Building::class);
    }
    



    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;
    protected $table = 'buildings';

    protected $primaryKey = 'id';

    protected $guarded = [];
    
    public function properties(){
        return $this->hasOne(Property::class,'building_id','id')->select(['id','building_id','slug','space','price','end_price','end_area']);
    }

  
}

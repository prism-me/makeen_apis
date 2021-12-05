<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB; 
use Spatie\QueryBuilder\QueryBuilder;


class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $property = Property::with('location','building')->get();
        echo json_encode(['data'=> $property , 'status'=>200]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category_type' => 'required',
            'short_content' => 'required',
            'long_description' => 'required',
            'space' => 'required',
            'bed' => 'required',
            'bathroom' => 'required'
        ]);
        $create = $request->except('area','city','map');
        $location = $request->only('area','city','map');
        if( ! $validator->fails()){
            $locationCreate = Location::create($location);
            $create['location_id'] = $locationCreate->id;
            $property = Property::create($create);

            if($property){

                echo json_encode(['message'=>'Data has been saved','status'=>200]);
            
            }else{
            
                echo json_encode(['message'=>'Data has not been saved','status'=>404]);
            
            }
        }
        else{
        
            echo json_encode(['errors'=>$validator->errors(),'status'=>404]);
        
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    
    public function show(Property $property)
    {
       $propertyDetail = Property::where('id',$property->id)->with('location','building')->get();
      
        if($propertyDetail){
           
            echo json_encode(['data'=>$propertyDetail , 'status'=> 200 ]);

        } else{

            echo json_encode(['data'=>'Not such property exit' , 'status'=> 404 ]);

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        
        if($property){ 
            echo json_encode(['data'=>$property , 'status'=> 200 ]);

        } else{

            echo json_encode(['data'=>'Not such property exit' , 'status'=> 404 ]);

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
       
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category_type' => 'required',
            // 'featured_image' => 'required',
            // 'short_content' => 'required',
            // 'long_description' => 'required'
        ]);
       
        
        if( ! $validator->fails()){
            $updateProperty = $request->except('location','building','area','city','map','updated_at','created_at');
            $updateLocation = $request->only('area','city','map');
            $propertyUpdate = Property::where('id',$property->id)->update($updateProperty);
            $locationUpdate = Location::where('id',$property->location_id)->update($updateLocation);
            if($propertyUpdate){

                echo json_encode(['message'=>'Data has been saved','status'=>200]);
            
            }else{
            
                echo json_encode(['message'=>'Data has not been saved','status'=>404]);
            
            }
        }
        else{
        
            echo json_encode(['errors'=>$validator->errors(),'status'=>404]);
        
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        if($property->delete()){

            echo json_encode(['message'=>'Data has been deleted.','status'=>200]);

        }else{

            echo json_encode(['message'=>'Data has not been deleted.','status'=>404]);

        }
    }

    public function search(){
        $property = QueryBuilder::for(Property::class)
                    ->allowedFilters(['Property_type','price','name'])
                    ->get();

        if($property){

            echo json_encode(['data' => $property , 'status' => 200]);
        
        }else{
        
            echo json_encode(['status'=>404,'message'=>'Error , while fetching data']);
        
        }

    }
   
}

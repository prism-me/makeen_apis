<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $building = Cache::remember('building' , 60*60*24 ,function() {
            
        return Building::with('properties')->get();
        
        });
        
        return json_encode(['data'=>$building,'status'=>200]);
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
            'city'=>'required',
            'area'=>'required',
            'short_description' => 'required',
        ]);

        if( ! $validator->fails()){

            $building = Building::create($request->all());

            if($building){
                echo json_encode(['status'=>200,'message'=>'Data has been added']);
            }else{
            echo json_encode(['status'=>404,'message'=>'Server Error while']);

            }
        }else{

            echo json_encode(['errors'=>$validator->errors(),'status'=>404]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function show(Building $building)
    {
        
        if($building){

            return json_encode(['data'=> $building,'status'=>200]);
        }else{
            return json_encode(['data'=>'no record exit']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Building $building)
    {
        $update = $request->except('updated_at','created_at');
            $building = Building::where('id',$building->id)->update($update);

            if($building){

                echo json_encode(['message'=>'Data has been saved','status'=>200]);
            
            }else{
            
                echo json_encode(['message'=>'Data has not been saved','status'=>404]);
            
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function destroy(Building $building)
    {
        if($building->delete()){

            echo json_encode(['message'=>'Data has been deleted.','status'=>200]);

        }else{

            echo json_encode(['message'=>'Data has not been deleted.','status'=>404]);

        }
    }
    
    public function area()
    {
         $building = Building::with('properties')->select('apace','price');
         dd($building);
        return json_encode(['data'=>$building,'status'=>200]);
    }
}

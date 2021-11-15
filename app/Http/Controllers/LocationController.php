<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $locations = Location::all();
        echo json_encode(['data'=> $locations , 'status'=>200]);
     
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
            'state' => 'required',
            'city' => 'required',
            'area' => 'required',
            'street' => 'required'
           
        ]);
        
        if( ! $validator->fails()){

            $location = Location::create($request->all());

            if($location){

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $location = Location::where('id',$id)->first();

        if($location){

            echo json_encode(['data'=> $location , 'status'=>200]);
            
        }else{

            echo json_encode(['message'=>'Data not Found','status'=>404]);

        }
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
            $location = Location::where('id',$location->id)->update($request->all());
            if($location){

                echo json_encode(['message'=>'Data has been saved','status'=>200]);
            
            }else{
            
                echo json_encode(['message'=>'Data has not been saved','status'=>404]);
            
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        if($location->delete()){

            echo json_encode(['message'=>'Data has been deleted.','status'=>200]);

        }else{

            echo json_encode(['message'=>'Data has not been deleted.','status'=>404]);

        }
    }
}

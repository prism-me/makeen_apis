<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CareerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $career = Career::all();

        echo json_encode([ 'data' => $career , 'status' => 200 ]);
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
            'designation' => 'required',
            'description' => 'required',
        ]);
        
        if( ! $validator->fails()){

            $career = Career::create($request->all());

            if($career){

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
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function show(Career $career)
    {
        echo json_encode([ 'data' => $career , 'status' => 200 ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function edit(Career $career)
    {
        echo json_encode([ 'data' => $career , 'status' => 200 ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Career $career)
    {
        $validator = Validator::make($request->all(), [
            'designation' => 'required',
            'description' => 'required',
        ]);
        
        if( ! $validator->fails()){

            $career = Career::where('id',$career->id)->update($request->all());

            if($career){

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
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function destroy(Career $career)
    {
        if($career->delete()){

            echo json_encode(['message'=>'Data has been deleted.','status'=>200]);

        }else{

            echo json_encode(['message'=>'Data has not been deleted.','status'=>404]);

        }
    }
}

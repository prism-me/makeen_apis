<?php

namespace App\Http\Controllers;

use App\Models\Emirate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmirateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emirates = Emirate::all();
        echo json_encode(['data'=> $emirates , 'status'=>200]);
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
            'slug' => 'required',
        ]);
        if( ! $validator->fails()){

            $emirate = Emirate::create($request->all());

            if($emirate){

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
        $data = Emirate::where('id',$id)->get();
        if($data){
            return json_encode(['data'=> $data,'status'=>200]);
        }else{
            return json_encode(['data'=>'no record exit']);
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
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required',
        ]);
       
        
        if( ! $validator->fails()){

            $update = $request->except('updated_at','created_at');

            $emirate = Emirate::where('id',$id)->update($update);

            if($emirate){

                echo json_encode(['message'=>'Data has been updated','status'=>200]);
            
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Emirate::where('id',$id)->delete();
        if($delete){

            echo json_encode(['message'=>'Data has been deleted.','status'=>200]);

        }else{

            echo json_encode(['message'=>'Data has not been deleted.','status'=>404]);

        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\studentCare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentCareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studentCare = studentCare::whereNull('deleted_at')->get();
    
        echo json_encode(['data'=> $studentCare , 'status' =>'200']);
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
            'title' => 'required',
            'description' => 'required',
            'thumbnail' => 'required',
            'video_link' => 'required',
            
        ]);
        
        if($validator->fails()){
       
            echo json_encode(['errors'=>$validator->errors(),'status'=>404]);
       
        }else{
            
           // return $request->all();
            
            $creatPage = studentCare::create($request->all());

            if($creatPage){
       
                echo json_encode(['message'=>'Data has been Saved','status'=>200]);
       
            }else{
       
                echo json_encode(['message'=>'Data has not been Saved' ,'status'=>404]);
       
            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\studentCare  $studentCare
     * @return \Illuminate\Http\Response
     */
    public function show(studentCare $studentCare)
    {
        echo json_encode(['data'=> $studentCare , 'status' =>'200']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\studentCare  $studentCare
     * @return \Illuminate\Http\Response
     */
    public function edit(studentCare $studentCare)
    {
        echo json_encode(['data'=> $studentCare , 'status' =>'200']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\studentCare  $studentCare
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, studentCare $studentCare)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'thumbnail' => 'required',
            'video_link' => 'required',
        ]);
        
        if($validator->fails()){
       
            echo json_encode(['errors'=>$validator->errors(),'status'=>404]);
       
        }else{

            $creatPage = studentCare::where('_id',$studentCare->_id)->update($request->all());

            if($creatPage){
       
                echo json_encode(['message'=>'Data has been Saved','status'=>200]);
       
            }else{
       
                echo json_encode(['message'=>'Data has not been Saved' ,'status'=>404]);
       
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\studentCare  $studentCare
     * @return \Illuminate\Http\Response
     */
    public function destroy(studentCare $studentCare)
    {
        if($studentCare->delete()){

            echo json_encode(['message'=>'Data has been deleted','status'=>200]);
        
        }else{
            echo json_encode(['message'=>'Data has not been deleted' ,'status'=>404]);
        }
    }
}

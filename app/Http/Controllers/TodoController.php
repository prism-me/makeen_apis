<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todo = Todo::all();
        return json_encode(['data'=>$todo,'status'=>200]);
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
            'description' => 'required',
            'status' => 'required',
        ]);

        if( ! $validator->fails()){

        $todo = Todo::create($request->all());

        if($todo){
            echo json_encode(['status'=>1,'message'=>'your task has been added']);
        }else{
           echo json_encode(['status'=>0,'message'=>'Server Error while']);

        }
    }else{

        echo json_encode(['errors'=>$validator->errors(),'status'=>404]);
    }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {   
        if($todo){

            return json_encode(['data'=> $todo,'status'=>200]);
        }else{
            return json_encode(['data'=>'no record exit']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        return json_encode(['data'=>$todo,'status'=>200]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        $todo->name = $request->name;
        $todo->description = $request->description;
        $todo->status = $request->status;

        
        if($todo->save()){
            echo json_encode(['status'=>200 ,'message'=>'your task has been added']);
        }else{
           echo json_encode(['status'=>404 , 'message'=>'Server Error while']);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        if($todo->delete()){
            echo json_encode(['status'=>200, 'message'=>'your task has been deleted']);
        }else{
           echo json_encode(['status'=>404, 'message'=>'Server Error while']);

        }  

    }
}

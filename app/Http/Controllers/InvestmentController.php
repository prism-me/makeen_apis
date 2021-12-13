<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use Illuminate\Http\Request;
use Validator;

class InvestmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $investment = Investment::all();
        return json_encode(['data'=>$investment,'status'=>200]);
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
            'from' => 'required',
            'to' => 'required',
            'description' => 'required',
            'completion_year' => 'required',
            'summary' => 'required',
            'ownership_type' => 'required',
            'building_content' => 'required',
            'amenities' => 'required',
            'location' => 'required',
            'area' => 'required',
            'parking' => 'required'
        ]);

        if( ! $validator->fails()){
            $investment = Investment::create($request->all());

            if($investment){
                echo json_encode(['status'=>1,'message'=>'Your Investment has been added']);
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
     * @param  \App\Models\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function show(Investment $investment)
    {
        if($investment){
            
            echo json_encode(['data'=>$investment , 'status'=> 200 ]);

        } else{

            echo json_encode(['data'=>'Not such team exit' , 'status'=> 404 ]);

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function edit(Investment $investment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Investment $investment)
    {
        $validator = Validator::make($request->all(), [
            'from' => 'required',
            'to' => 'required',
            'description' => 'required',
            'completion_year' => 'required',
            'summary' => 'required',
            'ownership_type' => 'required',
            'building_content' => 'required',
            'amenities' => 'required',
            'location' => 'required',
            'area' => 'required',
            'parking' => 'required'
        ]);

        if( ! $validator->fails()){
            $update = $request->except('updated_at','created_at');
            $investment = Investment::where('id',$investment->id)->update($update);

            if($investment){

                echo json_encode(['message'=>'Data has been saved','status'=>200]);
            
            }else{
            
                echo json_encode(['message'=>'Data has not been saved','status'=>404]);
            
            }
        }else{
            echo json_encode(['errors'=>$validator->errors(),'status'=>404]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Investment $investment)
    {
        if($investment->delete()){

            echo json_encode(['message'=>'Data has been deleted.','status'=>200]);

        }else{

            echo json_encode(['message'=>'Data has not been deleted.','status'=>404]);

        }
    }
}

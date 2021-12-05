<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Validator;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $team = Team::all();
        return json_encode(['data'=>$team,'status'=>200]);
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
            'department' => 'required',
            'name' => 'required',
            'designation' => 'required',
            'language' => 'required',
            'experience' => 'required',
            'location' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'linkdin' => 'required',
            'instagram' => 'required',
        ]);

        if( ! $validator->fails()){
            $todo = Team::create($request->all());

            if($todo){
                echo json_encode(['status'=>1,'message'=>'Your Team has been added']);
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
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        if($team){
            
            echo json_encode(['data'=>$team , 'status'=> 200 ]);

        } else{

            echo json_encode(['data'=>'Not such team exit' , 'status'=> 404 ]);

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
            $update = $request->except('updated_at','created_at');
            $team = Team::where('id',$team->id)->update($update);

            if($team){

                echo json_encode(['message'=>'Data has been saved','status'=>200]);
            
            }else{
            
                echo json_encode(['message'=>'Data has not been saved','status'=>404]);
            
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        if($property->delete()){

            echo json_encode(['message'=>'Data has been deleted.','status'=>200]);

        }else{

            echo json_encode(['message'=>'Data has not been deleted.','status'=>404]);

        }
    }
}

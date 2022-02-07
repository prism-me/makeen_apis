<?php

namespace App\Http\Controllers;

use App\Models\MoreAbout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MoreAboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $about = MoreAbout::orderBy('id', 'DESC')->get();
        return json_encode(['data'=>$about,'status'=>200]);
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
            'about_type' => 'required',
            'title' => 'required',
            'sub_title'=>'required',
            'description' => 'required',
        ]);

        if( ! $validator->fails()){

            $about = MoreAbout::create($request->all());

            if($about){
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
     * @param  \App\Models\MoreAbout  $moreAbout
     * @return \Illuminate\Http\Response
     */
    public function show(MoreAbout $moreAbout)
    {
        echo json_encode(['data'=>$moreAbout]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MoreAbout  $moreAbout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MoreAbout $moreAbout)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'sub_title'=>'required',
            'description' => 'required',

        ]);
      
        if( ! $validator->fails()){
            $update = $request->except('updated_at','created_at');
            $moreAbout = MoreAbout::where('id',$moreAbout->id)->update($update);

            if($moreAbout){
                echo json_encode(['status'=>200,'message'=>'Data has been added']);
            }else{
            echo json_encode(['status'=>404,'message'=>'Server Error while']);

            }
        }else{

            echo json_encode(['errors'=>$validator->errors(),'status'=>404]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MoreAbout  $moreAbout
     * @return \Illuminate\Http\Response
     */
    public function destroy(MoreAbout $moreAbout)
    {
        if($moreAbout->delete()){

            echo json_encode(['message'=>'Data has been deleted.','status'=>200]);

        }else{

            echo json_encode(['message'=>'Data has not been deleted.','status'=>404]);

        }
    }


    public function about($type){
        $section = MoreAbout::where('about_type','=', $type)->get();
        if($section){

            echo json_encode(['data' => $section , 'status' => 200]);
        
        }else{
        
            echo json_encode(['status'=>404,'message'=>'Error , while fetching data']);
        
        }
    }
}

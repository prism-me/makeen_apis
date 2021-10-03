<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::all();
        return json_encode(['data'=>$sections,'status'=>200]);
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
            'page_id'=>'required',
            'content' => 'required',
            'slug' => 'required',

        ]);

        if( ! $validator->fails()){

        $section = Section::create($request->all());

        if($section){
            echo json_encode(['status'=>200,'message'=>'Section has been added']);
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
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        $sections = Section::all();
        return json_encode(['data' => $section , 'status' => 200]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        $sections = Section::all();
        return json_encode(['data' => $section , 'status' => 200]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        $validator = Validator::make($request->all(), [

            'name' => 'required',
            'page_id'=>'required',
            'content' => 'required',
            'slug' => 'required',

        ]);

        if( ! $validator->fails()){

        $section = Section::where('_id',$section->_id)->update($request->all());

        if($section){
            echo json_encode(['status'=>200,'message'=>'Section has been added']);
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
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        
    }

    public function all_sections($id){
        
        $section = Section::where('page_id','=', $id)->get();
        
        if($section){

            echo json_encode(['data' => $section , 'status' => 200]);
        
        }else{
        
            echo json_encode(['status'=>404,'message'=>'Error , while fetching data']);
        
        }
    }


}

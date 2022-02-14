<?php

namespace App\Http\Controllers;

use App\Models\Query;
use Illuminate\Http\Request;
use Validator;

class QueryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Query::all();

        echo json_encode([ 'data' => $query , 'status' => 200 ]);
    }


    public function store(Request $request)
    {
        
        $query = Query::create($request->all());

        if($query){

            echo json_encode(['message'=>'Data has been saved','status'=>200]);
        
        }else{
        
            echo json_encode(['message'=>'Data has not been saved','status'=>404]);
        
        }    
       
       
    }
    
     public function destroy($id)
   {
        $delete  = Query::where('id',$id)->delete();    
         if($delete){
                echo json_encode(['message'=>'Data  deleted successfully.','status'=>200]);

            }else{

                echo json_encode(['message'=>'server error','status'=>404]);
            }
   }

}

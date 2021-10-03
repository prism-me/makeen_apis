<?php

namespace App\Http\Controllers;

use App\Models\ContactQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Mail\contactQueryEmail;
use App\Mail\waitList;
use App\Mail\requestCall;
use App\Mail\bookTour;
use Illuminate\Support\Facades\Mail;
class ContactQueryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
    }

    public function contact_form(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'flag'=>'required'
            
        ]);
        
        if(!$validator->fails()){

            $contact  = ContactQuery::create($request->all());

            if($contact){

                try {
                    $email = 'bilal@prism-me.com';

                    Mail::to($email)->send(new contactQueryEmail($request->all()));

                } catch (\Throwable $th) {

                    echo 'Error - '.$th;
                }

                echo json_encode(['message'=>'Your request has been submitted, you will be contacted soon.','status'=>200]);

            }else{

                echo json_encode(['message'=>'server error','status'=>404]);
            }
       
        }
        else{
        
            echo json_encode(['errors'=>$validator->errors(),'status'=>404]);
        
        }
    }
    
    public function waitlist(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'flag' =>'required',
            
        ]);
        
        if(!$validator->fails()){

            $contact  = ContactQuery::create($request->all());

            if($contact){

                try {
                    $email = 'bilal@prism-me.com';

                    Mail::to($email)->send(new waitList($request->all()));

                } catch (\Throwable $th) {

                    echo 'Error - '.$th;
                }

                echo json_encode(['message'=>'Your request has been submitted, you will be contacted soon.','status'=>200]);

            }else{

                echo json_encode(['message'=>'server error','status'=>404]);
            }
       
        }
        else{
        
            echo json_encode(['errors'=>$validator->errors(),'status'=>404]);
        
        }
    }
    
    public function request_for_call(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'parent_name' => 'required',
            'phone' => 'required',
            'flag' =>'required',
            
        ]);
        
        if(!$validator->fails()){

            $contact  = ContactQuery::create($request->all());

            if($contact){

                try {
                    $email = 'bilal@prism-me.com';

                    Mail::to($email)->send(new requestCall($request->all()));

                } catch (\Throwable $th) {

                    echo 'Error - '.$th;
                }

                echo json_encode(['message'=>'Your request has been submitted, you will be contacted soon.','status'=>200]);

            }else{

                echo json_encode(['message'=>'server error','status'=>404]);
            }
       
        }
        else{
        
            echo json_encode(['errors'=>$validator->errors(),'status'=>404]);
        
        }
    }
    
    public function book_tour(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'parent_name' => 'required',
            'parent_phone' => 'required',
            'parent_email' => 'required',
            'flag' =>'required',
            
        ]);
        
        if(!$validator->fails()){

            $contact  = ContactQuery::create($request->all());

            if($contact){

                try {
                    $email = 'bilal@prism-me.com';

                    Mail::to($email)->send(new bookTour($request->all()));

                } catch (\Throwable $th) {

                    echo 'Error - '.$th;
                }

                echo json_encode(['message'=>'Your request has been submitted, you will be contacted soon.','status'=>200]);

            }else{

                echo json_encode(['message'=>'server error','status'=>404]);
            }
       
        }
        else{
        
            echo json_encode(['errors'=>$validator->errors(),'status'=>404]);
        
        }
    }


    public function get_all_queries(){


        $data = ContactQuery::all();

        return $data;
    
    }

}



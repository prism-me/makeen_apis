<?php

namespace App\Http\Controllers;

use App\Models\ContactQuery;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File; 
use BunnyCDN\Storage\BunnyCDNStorage;
use Corbpie\BunnyCdn\BunnyAPI;


class ContactQueryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $bunnyCDNStorage ;   
    public $storageZone = 'makeen';
    public $directory = '/makeen/images';
    public $access_key = 'ca77159b-71b5-4cc3-a8dc9785778b-1415-4486';
    //public $bunny ;

    public function __construct()
    {
    
       $this->bunnyCDNStorage = new BunnyCDNStorage($this->storageZone, $this->access_key, "sg");
    }

    public function contact_form(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            "mk_name" => "required",
            "mk_phone" => "required",
            "mk_email" => "required",
            "mk_property_category" =>"required",
            "mk_property_type" => "required",
            "mk_flag"=>"required",

        ]);
        
        if(!$validator->fails()){

            if(ContactQuery::create($request->all())){

                echo json_encode(['message'=>'Data has been saved.','status'=>200]);
            
            }else{
            
                echo json_encode(['message'=>'Data has not been saved.','status'=>404]);
            
            }
        }
        else{
        
            echo json_encode(['errors'=>$validator->errors(),'status'=>404]);
        
        }
    }

    public function agent_form(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            "mk_company_name" => "required",
            "mk_trade_license_number" => "required",
            "mk_trade_license_file" => "required",
            "mk_rera_orn_number" => "required",
            "mk_rera_orn_file" => "required",
            "mk_broker_name" =>"required",
            "mk_broker_id_file" => "required",
            "mk_area_specialty" => "required",
            "mk_phone"=>"required",
            "mk_email"=>"required",
            "mk_noc_file"=>"required",

        ]);

        if( ! $validator->fails()){
           
            
        return 'check';

        $data = $request['data'];
        
        
        $images = $request->file('images');
        
        $list = [ 0=>'mk_trade_license_file', 1=>'mk_rera_orn_file',2=>'mk_broker_id_file' ,3 =>'mk_noc_file' ];
        
        $files = [];
        
        if($data && $images)
        {  
            
            $i =0 ;
            foreach($list as $single)
            {   

                if($request->file($single)){
                
                $file=$request->file($single);
                //$d = json_decode($d , true);
                 
                $without_ext_name= $this->slugify(preg_replace('/\..+$/', '', $file->getClientOriginalName()));
            
                $name = $without_ext_name .'-'. time().rand(1,100).'.'.$file->extension();
                $files[$i]['avatar'] = $name;
                $files[$i]['url'] = 'https://makeen.b-cdn.net/forms/'. $name ;
                $files[$i]['alt_tag'] = $d['alt_text'];  
                $files[$i]['type'] = $type;  

                if($this->bunnyCDNStorage->uploadFile($images[$i]->getPathName() , $this->storageZone."/images/{$name}")){
                    
                $isUploaded = Upload::create(['avatar'=> $name,'url' =>$files[$i]['url'] ,'alt_tag' => $files[$i]['alt_tag'] ,'type' =>'asdf']);
                    
                echo json_encode(['message' =>'media has uploaded.' , 'status' =>200]);
                
                }else{
        
                   return $errors = ['message'=>'server issue','status'=>404 ,'image_name'=>$file->getClientOrignalName()];
                }

                $i ++;
            }
         }else{
              echo json_encode(['message' =>'files are not uploaded' , 'status' =>404]);
             
         }
        
        }


        
        

        if(!$validator->fails()){

            if(Agent::create($request->all())){

                echo json_encode(['message'=>'Data has been saved.','status'=>200]);
            
            }else{
            
                echo json_encode(['message'=>'Data has not been saved.','status'=>404]);
            
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






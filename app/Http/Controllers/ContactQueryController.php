<?php

namespace App\Http\Controllers;

use App\Models\ContactQuery;
use App\Models\Agent;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File; 
use BunnyCDN\Storage\BunnyCDNStorage;
use Corbpie\BunnyCdn\BunnyAPI;
use Illuminate\Support\Facades\Http;


class ContactQueryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $bunnyCDNStorage ;   
    public $storageZone = 'makeen';
    public $directory = '/makeen/forms';
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
            // "mk_property_type" => "required",
            "mk_flag"=>"required",

        ]);
        
        if(!$validator->fails()){

            if(ContactQuery::create($request->all())){
            
            
            $response = Http::asForm()->post('https://adfstst.ghobash.com/adfs/oauth2/token', [
                'client_secret' => 'XnLidazZlZHAcceAGYy5t4bmsXQRGLXyh8gYmAKT',
                'client_id' => '6b82ccfc-c2f9-4955-982a-5b8c741eae24',
                'username' => 'ghobash\makeen.ecommerce',
                'password' => 'Ht#4Tu@12W*',
                'resource' => 'https://makeenuat.ghobash.com/api/data/v8.2/',
                'grant_type' => 'password',
            ]);
            
            
            $data = json_decode($response, true);
             
            if($response->successful() && !empty($data['access_token']) ){
            if($data['access_token']){
                $lead_response = Http::withToken($data['access_token'])->accept('application/json')->withHeaders([
                    
                    'Accept-Encoding' => 'gzip,deflate',
                    'Host' => 'makeenuat.ghobash.com',
                ])->post('https://makeenuat.ghobash.com/api/data/v8.2/leads', [

                    'subject' => $request->mk_email. "- Makeen Lead ",
                    'iqra_LeadSource@odata.bind' => 'iqra_leadsources(5d97c7d3-9996-eb11-b820-00155d048ec6)',
                    'iqra_LeadSubSource@odata.bind' => 'iqra_leadsubsources(fceb1a2b-9b96-eb11-b820-00155d048ec6)',
                    'iqra_PropertyCategory@odata.bind' => 'iqra_propertycategories(e739922d-9e96-eb11-b820-00155d048ec6)',
                    'iqra_PropertySubCategory@odata.bind' => 'iqra_propertysubcategories(bc2cad98-9e96-eb11-b820-00155d048ec6)',
                    'iqra_Location_City@odata.bind' => 'iqra_cities(423c85c3-60e4-eb11-b826-00155d9c024a)',
                    'iqra_LocationEmirates@odata.bind' => 'iqra_locationemirateses(505ffada-9f96-eb11-b820-00155d048ec6)',
                    'ownerid@odata.bind' => 'systemusers('.$request->CRM_id.')',
                    'iqra_needby' => '2021-03-19T20:00:00Z',
                    'iqra_sizebeds' => '6',
                    'iqra_budgetinaedfor1year' => 0,
                    'iqra_locationareaname' => 'N/A',
                    'iqra_custtype' => '1',
                    'iqra_isexistingcustomer' =>false,
                    'iqra_customername' =>$request->mk_name,
                    'iqra_contname' => 'testing',
                    'description' =>$request->mk_message,
                    'emailaddress1' =>$request->mk_email,
                    'telephone1' =>$request->mk_name,
                    'mobilephone' =>$request->mk_phone,
                    'iqra_morecontactinfo' =>$request->mk_property_type

                ]);

                
                if($lead_response->successful()){
                      
                    echo json_encode(['message'=>'Data has been saved.','status'=>200 ,'id'=>$lead_response->header('Location')]);

                }else{
                    echo json_encode(['message'=>'CRM authentication issue.','status'=>404]);
                }
            
            
                 
             }
                
            }
                         else{
                 echo json_encode(['message'=>'Authentication error','status'=>403]);
            }
                
            }
            else{
            
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
                // "mk_broker_name" =>"required",
                "mk_area_specialty" => "required",
                // "mk_broker_id" => "required",
                "mk_phone"=>"required",
                "mk_email"=>"required",
                "mk_noc_file"=>"required",

        ]);

        if( ! $validator->fails()){

        $data['mk_rera_orn_file'] = $request['mk_rera_orn_file'];
        $data['mk_noc_file'] = $request['mk_noc_file'];
        $data['mk_trade_license_file']= $request['mk_trade_license_file'];
    
  
        
        $list = [ 0=>'mk_trade_license_file', 1=>'mk_rera_orn_file',2 =>'mk_noc_file' ];
            
     
        $files = [];
        $errors =[];
      
        $dat = $request->all(); 
        
        if( $request['mk_rera_orn_file'] &&  $request['mk_noc_file'] && $request['mk_trade_license_file'] )
        {  
            
            $i =0 ;
            foreach($list as $single)
            {   

                if($request->file($single)){
                
                $file=$request->file($single);
                
                 
                $without_ext_name= $this->slugify(preg_replace('/\..+$/', '', $file->getClientOriginalName()));
            
                $name = $without_ext_name .'-'. time().rand(1,100).'.'.$file->extension();
               
                $filename_list = $list[$i];    

                if($filename_list === 'mk_trade_license_file'){

                     $dat['mk_trade_license_file'] = 'https://makeen.b-cdn.net/forms/'. $name ; 
                    

                }elseif($filename_list === 'mk_rera_orn_file'){

                    $dat['mk_rera_orn_file'] = 'https://makeen.b-cdn.net/forms/'. $name ; 

                }elseif($filename_list === 'mk_noc_file'){

                    $dat['mk_noc_file'] = 'https://makeen.b-cdn.net/forms/'. $name ; 
                
                }else{
                    echo 'upload issue';
                }
                
                if($this->bunnyCDNStorage->uploadFile($file->getPathName() , $this->storageZone."/images/{$name}")){
                    
               // $isUploaded = Upload::create(['avatar'=> $name,'url' =>$files[$i]['url'] ,'alt_tag' => $files[$i]['alt_tag'] ,'type' =>'asdf']);
                    
                $isUploaded = Upload::create(['avatar'=> $name,'url' =>$files[$i]['url'] ,'alt_tag' => $files[$i]['alt_tag'] ,'type' =>'asdf']);
               
                // $agent = Agent::create();

                }else{
        
                   return $errors = ['message'=>'server issue','status'=>404 ,'image_name'=>$file->getClientOrignalName()];
                }

            }
            $i ++;
         }

         if(!$errors){
            $is = Agent::create($dat);
            
        if($is){
            echo json_encode(['message' =>'uploaded' , 'status' =>200]);

        }else{
            echo json_encode(['message' =>' not uploaded' , 'status' =>404]);

        }
        }

        
        }else{
            echo json_encode(['message' =>'files are not uploaded' , 'status' =>404]);
           
       }

        }
        else{
        
            echo json_encode(['errors'=>$validator->errors(),'status'=>404]);
        
        }
    }


    public function get_all_agent(){
        $data = Agent::all();
        return $data;
    }

    public function get_all_queries(){
        $data = ContactQuery::all();
        return $data;
    }

    public function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
       // $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            echo 'n-a';
        }

        return $text;
    }
}






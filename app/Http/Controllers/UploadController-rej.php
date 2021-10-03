<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File; 
use BunnyCDN\Storage\BunnyCDNStorage;
use Corbpie\BunnyCdn\BunnyAPI;
class UploadController extends Controller
{    
    public $bunnyCDNStorage ;   
    public $storageZone = 'american-gulf-school';
    public $directory = '';
    public $access_key = '7d97e932-b275-45a0-91572ab4601f-bb8a-42ea';
    public $bunny_ref ;

    public function __construct()
    {
        $this->bunny_ref = new bunnyAPI();//Initiate the class

        $this->bunny_ref->zoneConnect($this->storageZone, $this->access_key);
    }

    public function upload_media(Request $req)
    {
    
        if($this->bunnyCDNStorage->uploadFile('C:\Users\bilal\Downloads\Untitled.png', $this->storageZone."/images/uploaded-new.jpg")){
        
            echo json_encode(['message'=>'file has been uploaded.','status'=>200]);

        }else{

            echo json_encode(['message'=>'server issue','status'=>404]);
        }

    }


    public function cobii(Request $req){

        $this->bunny_ref->zoneConnect($this->storageZone, $this->access_key);
       
        // if($this->bunny_ref->uploadFile('C:\Users\bilal\Downloads\Untitled.png', 'images/new-added.png')){
        //     echo 'uploading';
        // }else{
        //     echo 'errir';
        // }

      $data = $this->bunny_ref->listFiles('/images');
       // return $this->bunny_ref->listFiles('/american-gul-school/images');

       foreach($data->data as $list){

        return $list;
       }

    }


}

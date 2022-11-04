<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Models\Upload;

use Validator;
use Illuminate\Support\Facades\File; 
use BunnyCDN\Storage\BunnyCDNStorage;
use Corbpie\BunnyCdn\BunnyAPI;

class ReviewController extends Controller
{
   public $bunnyCDNStorage ;   
    public $storageZone = 'makeen';
    public $directory = '/makeen/images';
    public $access_key = 'ca77159b-71b5-4cc3-a8dc9785778b-1415-4486';

    public function __construct()
    {
    
       $this->bunnyCDNStorage = new BunnyCDNStorage($this->storageZone, $this->access_key, "sg");
    }

    public function index()
    {
        $review = Review::all();
        return json_encode(['data'=>$review,'status'=>200]);
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
       
        
         $data = $request->all();
            $review = Review::create($data);
            
            if($review)
            {
            
                echo json_encode(['status'=>1,'message'=>'Your Review has been added']);
            
                
            }else{
            
                echo json_encode(['status'=>0,'message'=>'Server Error while']);
            
                
            }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        return json_encode(['data' => $review,'status'=>'Data Retrived Successfully']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        
      
        $data = $request->all();
      
        
        $update = $review->update($data);
    
        if($review->update()){
            
            echo json_encode(['message'=>'Data has been Updated.','status'=>200]);
            
        }else{
            
            echo json_encode(['message'=>'Data has not been Deleted.','status'=>404]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        if($review->delete()){

            echo json_encode(['message'=>'Data has been deleted.','status'=>200]);

        }else{

            echo json_encode(['message'=>'Data has not been deleted.','status'=>404]);

        }
    }

  
}

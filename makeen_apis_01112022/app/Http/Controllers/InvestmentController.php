<?php
namespace App\Http\Controllers;
use App\Models\Investment;
use App\Models\Upload;
use Illuminate\Http\Request;
use Validator;
use BunnyCDN\Storage\BunnyCDNStorage;
use Corbpie\BunnyCdn\BunnyAPI;
class InvestmentController extends Controller
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
        $investment = $request->all();
    
       
        $input = json_decode($investment['investmentData'][0]);
     
            $file = $request->file('image');
          
            $without_ext_name=preg_replace('/\..+$/', '', $file->getClientOriginalName());

            $name = $without_ext_name .'-'. time().rand(1,100).'.'.$file->extension();

            $files['name'] = $name;
            $files['url'] = 'https://makeen.b-cdn.net/forms/'. $name ;
            $files['alt_tag'] = time().rand(1,100); 
            $files['type'] = 'img'; 
                if($this->bunnyCDNStorage->uploadFile($file->getPathName() , $this->storageZone."/forms/{$name}")){
                $isUpdated = Upload::create(['avatar'=> $name,'url' =>$files['url'],'alt_tag'=>$files['alt_tag'],'type'=>$files['type']]);
                 $create= array(
                        'from' => $input->from,
                        'to' => $input->to,
                        'description' =>$input->description ,
                        'completion_year' => $input->completion_year,
                        'summary' => $input->summary,
                        'ownership_type' => $input->ownership_type ,
                        'building_content' => $input->building_content,
                        'location' => $input->location,
                        'amenities' => $input->amenities,
                        'area' => $input->area,
                        'email' => $input->email,
                        'parking' => $input->parking,
                        'image' => $files['url']
                );
        
                    $save = Investment::create($create);
                    if($save){
                        echo json_encode(['status'=>1,'message'=>'Your Investment has been added']);
                    }else{
                        echo json_encode(['status'=>0,'message'=>'Server Error while']);
                    }
                
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
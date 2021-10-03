<?php

namespace App\Http\Controllers;

use App\Models\General;
use Illuminate\Http\Request;
use BunnyCDN\Storage\BunnyCDNStorage;

class GeneralController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\General  $general
     * @return \Illuminate\Http\Response
     */
    public function show(General $general)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\General  $general
     * @return \Illuminate\Http\Response
     */
    public function edit(General $general)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\General  $general
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, General $general)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\General  $general
     * @return \Illuminate\Http\Response
     */
    public function destroy(General $general)
    {
        //
    }

    public function bunnycdn(Request $request){

            // $text = "Custom Facade in Laravel 8";
    $storageZone = 'american-gulf-school';
    
    $apiKey = '7d97e932-b275-45a0-91572ab4601f-bb8a-42ea';

    $bunnyCDNStorage = new BunnyCDNStorage($storageZone, $apiKey, "de");
    return $request->upload;
    
    $bunnyCDNStorage->uploadFile($request->upload , $storageZone."/images/helloworld.jpg");



    }

    public function get_list(){

        
        $storageZone = "american-gulf-school";
    
        $apiKey = '7d97e932-b275-45a0-91572ab4601f-bb8a-42ea';
    
        $bunnyCDNStorage = new BunnyCDNStorage($storageZone, $apiKey, "de");
        
        $list = $bunnyCDNStorage->getStorageObjects("american-gulf-school/images");

        return $list;   
    }
}

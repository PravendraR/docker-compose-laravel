<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class TestCont extends Controller
{
   
    public function __invoke()
    {
        try 
        {
            $this->globalErrorsHandle();
        } catch(\Exception $e){
            return response()->json([
                'message'=>'Error Occured',
            ],500);
        }
        
        return response->json([
            "message"=> "Hi",
        ]);
    }
    protected function globalErrorsHandle(){
        throw new Exception(message: "Customer Response for Errors");
        
    }
    /* function getData($id,$name=null){
        return DB::table('migrations')->get();
        // return ["App"=>"Unity","UniqueId"=>"e32rfd434","id"=>$id,"Name"=>$name];
    } */
    //
}

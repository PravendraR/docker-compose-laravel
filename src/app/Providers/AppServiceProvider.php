<?php

namespace App\Providers;

// use GuzzleHttp\Psr7\Response;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    
    public function register(): void
    {
        /**
         * Here we define common messages format
         */
        Response::macro('success',function ($message, $token=null, $data=[]) {
            $response = [
                'Status' => true,
                
            ];
            if(!empty($message)){
                if(count($message)>2)
                    $response['msgCode'] = $message[2];
                $response['message'] = $message[0];
                $code = $message[1];
            }
            if(!empty($data))
                $response['data'] = $data;
            return response()->json($response,$code)->header('Token',$token);
        });
        Response::macro('error',function ($message,$token=null, $error=[]) {
            $response = [
                'Status' => false,
            ];
            
            if(!empty($message)){
                if(count($message)>2)
                    $response['msgCode'] = $message[2];
                $response['message'] = $message[0];
                $code = $message[1];
                $code = $message[1];
            }
            if(!empty($error))
                $response['error'] = $error;
            return response()->json($response,$code)->header('Token',$token);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

<?php

namespace App\Http\Helpers;

use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\User;

class Helper
{

    
    
    public static function verifyAccess($permission)
    {
        $userId = auth()->user();
        $user = User::find($userId->id);
        if($user->hasPermissionTo($permission))
            return true;
        else
            return false;

        // throw new HttpResponseException(response: response()->json(config(key:'msgconfig.user_access_fail')));
    }
    public static function sendUserError($message, $errors = [])
    {
        $response = ['success' => false, 'msg' => $message[0]];
        if (!empty($errors)) {
            $response['data'] = $errors;
        }

        throw new HttpResponseException(response: response()->json($response, $message[1]));
    }
    public static function sendUserSuccess($message = [], $data = [])
    {
        $response = ['success' => true, 'msg' => Helper::$responseMessages[$message][0]];
        if (!empty($data)) {
            $response['data'] = $data;
        }

        throw new HttpResponseException(response: response()->json($response, Helper::$responseMessages[$message][1]));
    }
}

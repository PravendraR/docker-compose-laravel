<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customers;
use App\Models\Menu;
use Illuminate\Support\Facades\Hash;
use  App\Http\Helpers\Helper;
use Illuminate\Support\Facades\DB;
use Validator;
use Spatie\Permission\Models\Role;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Http;

class MenuController extends Controller
{
    public $api;
    public function __construct()
    {
        $this->middleware('auth:api');
         $this->api = new ApiController;
    }

    public function getMenuInfo(Request $request) {
        
        $ishavePermission = Helper::verifyAccess('user.list');
        if($ishavePermission){
            $newToken = $this->api->getNewToken($request); // This method invalidate given token and generate new one.
            if (!empty($newToken)) {   
                // $menu = DB::table('tbl_menus')->where('hideMenu','0')->where('isActive','Yes')->whereNull('parentId')->get();  
                $Resp = $this->reccurssion(null);
                if($Resp)
                {
                    /* $i=0;
                    
                    foreach($menu as $val){
                        // $Resp = $val;
                        $submenu = (object)DB::table('tbl_menus')->where('hideMenu','0')->where('isActive','Yes')->where('parentId',$val->id)->get();
                        $val->child=$submenu;
                        $Resp[]= $val;
                        
                    } */
                    return response()->success(config(key: 'msgconfig.success'), $newToken, $Resp);
                }
                else
                    return response()->error(config(key: 'msgconfig.noRecordFound'), $newToken, $Resp);
            }
            return response()->error(config(key: 'msgconfig.newTolenFail'),null,$ishavePermission);
        }
        return response()->error(config(key: 'msgconfig.user_access_fail'),null,$ishavePermission);
    }
    public function reccurssion($id,$i=1){
        if($i >= 500) return ;
        $menu = DB::table('tbl_menus')->where('hideMenu','0')->where('isActive','Yes')->where('parentId',$id)->get(); 
        if(count($menu)){
            foreach($menu as $child){
                
                $child->child= $this->reccurssion($child->id,$i++);
                $resp[]=$child;
               
            }
            return $resp; 
        }
        else 
            return $menu;
    }
}

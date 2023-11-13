<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use  App\Http\Helpers\Helper;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Support\Collection;
use App\Http\Requests\UserRequest;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Response as HttpResponse;
use Nette\Utils\Strings;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register', 'login']]);
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'userName' => 'required|Min:8|alpha_dash:ascii|unique:users',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            return response()->error(config(key:'msgconfig.validation'),$validator->errors());
        }
        $status = DB::table('tbl_user_status')->select('id')
            ->where('Status', 'Active')
            ->where('isActive', 'Yes')
            ->where('CompanyId', $request->CompID)->count();
        if ($status) {
            $user = User::create(array_merge(
                $validator->validated(),
                ['password' => Hash::make($request->password)],
                ['status_id' => $status],
                ['companyId' => $request->CompID]

            ));
            $user->assignRole('admin');
            $user->givePermissionTo(['name' => 'user.list']);
            return response()->success(config(key: 'msgconfig.success'),null,$user);
        } else {
            return response()->error(config(key: 'msgconfig.user_status'));
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userName' => 'required|Min:8|alpha_dash:ascii',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->error(config(key: 'msgconfig.validation'),$validator->errors());
        }
        $status = DB::table('tbl_user_status')->select('id')
                                            ->where('Status', 'Active')
                                            ->where('isActive', 'Yes')
                                            ->where('CompanyId', $request->CompID)->first();
        
        if ($status) {
            $curStatus = $status->id;
            $query = [
                'userName' => $request->userName,
                'password' => $request->password,
                'status_id' =>  $curStatus,
                'companyId' => $request->CompID
            ];

            if (!$token = auth()->attempt($query)) {
                return response()->error(config(key: 'msgconfig.login_fails'));
            }

            return response()->success(config(key: 'msgconfig.login_success'), $token);
        } else {
            return response()->error(config(key: 'msgconfig.unathorized'));
        }
    } // End block here

    public function getToken(Request $request)
    {
        $bearer = $request->header('Authorization');
        $token = str_ireplace("bearer ", "", $bearer);
        return $token;
    } // End block here
    public function profile(Request $request)
    {
        $ishavePermission = Helper::verifyAccess('user.list');
        if($ishavePermission){
            $newToken = $this->getNewToken($request);
            if ($newToken) {
                $user = auth()->user(); // get user info for profile

                return response()->success(config('msgconfig.success'), $newToken,$user);
            } else {
                return response()->error(config('msgconfig.newTolenFail'), $newToken);
            }
        }
    return response()->error(config(key: 'msgconfig.user_access_fail'));
    } // End block here
    public function planList(Request $request)
    {
        $ishavePermission = Helper::verifyAccess('user.list');
        if($ishavePermission){
            $newToken = $this->getNewToken($request);
            if ($newToken) {
                $user = auth()->user(); // get user info for profile

                return response()->success(config('msgconfig.success'), $newToken,$user);
            } else {
                return response()->error(config('msgconfig.newTolenFail'), $newToken);
            }
        }
    return response()->error(config(key: 'msgconfig.user_access_fail'));
    } // End block here

    public function addPermissionToRole(Request $request) : Response
    {
       
        $ishavePermission = Helper::verifyAccess('user.list');
        if($ishavePermission){
            $validator = Validator::make($request->all(), [
                'permissionName' => 'required',
                'roleName' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->error(config(key: 'msgconfig.validation'),$validator->errors());
            }
            $newToken = $this->getNewToken($request);
            if ($newToken) {
                $user = auth()->user();
                $userData = User::find($user->id);
                // $roles = Role::getRoleNames()->pluck('name',$request->roleName);
                // $roles = Role::create(['name' => $request->roleName]);
                $roles = Role::findByName($request->roleName);
                // $roles = $userData->getRoleNames();
                 if (!$roles->hasPermissionTo($request->permissionName)){
                    $msg = $roles->givePermissionTo($request->permissionName);
                    $data = $roles->permissions->pluck('name')->toArray();
                    // dd($data);
                    if(array_search($request->permissionName,$data))
                        $msg = 'Added permission successfull';
                    else 
                        $msg = 'Not found.';
                    /* "data": "[\"user.list\"]{\"guard_name\":\"api\",\"name\":\"role_permissions_add\",
                        \"updated_at\":\"2023-11-07T04:44:22.000000Z\",\"created_at\":\"2023-11-07T04:44:22.000000Z\",\"id\":6}" */

                    return response()->success(config('msgconfig.success'), $newToken,$msg);
                }
                return response()->success(config('msgconfig.success'), $newToken,$roles);
            }
            return response()->error(config(key: 'msgconfig.newTolenFail'));
        }
        return response()->error(config(key: 'msgconfig.user_access_fail'));

    }

    public function addNewRole(Request $request): Response
    {
        /* 
        // $role->givePermissionTo($permission); // assign permissions to a role
        // $permission->assignRole($role); // assign permissions to a role
        // $role->revokePermissionTo($permission); // remove permission from a role
        // $permission->removeRole($role);
        // get a list of all permissions directly assigned to the user
        $permissionNames = $user->getPermissionNames(); // collection of name strings
        $permissions = $user->permissions; // collection of permission objects

        // get all permissions for the user, either directly, or from roles, or from both
        $permissions = $user->getDirectPermissions();
        $permissions = $user->getPermissionsViaRoles();
        $permissions = $user->getAllPermissions();

        // get the names of the user's roles
        $roles = $user->getRoleNames(); // Returns a collection 

        $users = User::role('writer')->get(); // Returns only users with the role 'writer'
        $nonEditors = User::withoutRole('editor')->get(); // Returns only users without the role 'editor'
        */
        $role = Role::create(['name' => $request->role_name]);
        $all =  Role::all()->pluck('name');
        // $data = $userData->getPermissionsViaRoles();
        Helper::sendUserSuccess(Helper::LOGIN_SUCCESS, $all);
        // dd($all);
    }

    public function getRoles(Request $request): Response
    {
        $newToken = $this->getNewToken($request);
        if ($newToken) {
            $user = auth()->user();
            $userData = User::find($user->id);
            $data = $userData->getAllPermissions();
            
            return response()->success(config('msgconfig.success'), $newToken, $data);
        } else {
            return response()->error(config('msgconfig.newTolenFail'), $newToken);
        }
        // Helper::sendUserSuccess(Helper::LOGIN_SUCCESS, $data);
        // dd($data);
    }

    public function createPermission(Request $request)
    {
        $ishavePermission = Helper::verifyAccess('user.list');
        if($ishavePermission){
            $validator = Validator::make($request->all(), [
                'permissionName' => 'required'
            ]);
    
            if ($validator->fails()) {
                return response()->error(config(key: 'msgconfig.validation'),$validator->errors());
            }
            $newToken = $this->getNewToken($request);
            if ($newToken) {
        
                $permission = Permission::create(['name' => $request->permissionName]);
                return response()->success(config(key:'msgconfig.success'), $newToken);
            }
            return response()->error(config('msgconfig.newTolenFail'), $newToken);
        }
        return response()->error(config(key: 'msgconfig.user_access_fail'));
    }
    public function userNameVerify(Request $request)
    {
        $newToken = $this->getNewToken($request);
        if ($newToken) {
            $validator = Validator::make($request->all(), [
                'userName' => 'required|Min:8|alpha_dash:ascii|unique:users',
            ]);

            if ($validator->fails()) {
                return response()->error(config('msgconfig.validation'),$newToken, $validator->errors());
            }

            $status = DB::table('users')->where('userName', $request->userName)
                                     ->where('CompanyId', $request->CompID)
                                     ->get('status_id');

            if (count($status)) {
                return response()->success(config('msgconfig.registered', $newToken));
            } else {
                return response()->error(config('msgconfig.unregistered'), $newToken);
            }
        } else {
            return response()->error(config('msgconfig.newTolenFail'));
        }
    } // End block here

    public function getNewToken(Request $request)
    {
        $token = $this->getToken($request);
        return $token;
        if (auth()->check($token)) {
            $user = auth()->user(); // get user info to generate token
            return $this->reGenToken($user);
           
        } else {
            return false;
        }
    } // End block here

    public function reGenToken($user)
    {
        auth()->logout(true); // logout to invalidate used token
        $token = auth()->login($user); // get new token
        return $token;
    } // End block here  

}

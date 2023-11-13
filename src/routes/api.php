<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestCont;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\MenuController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('data/{id}/{name}',[TestCont::class,'getData']); */
Route::post('/', [ApiController::class, "index"]); // Default route for undecleared routes

Route::group(['middleware'=>'api','middleware'=>'api_gateway','prefix'=>'unity'], function($router){
    Route::post('/register',[ApiController::class,'register']);
    Route::post('/authenticate',[ApiController::class,'login']);
    Route::post('/profile',[ApiController::class,'profile']);
    Route::post('/userNameVerify',[ApiController::class,'userNameVerify']);
    Route::post('/roles',[ApiController::class,'getRoles']);
    Route::post('/addRole',[ApiController::class,'addNewRole']);
    Route::post('/addPermissionToRole',[ApiController::class,'addPermissionToRole']);
    Route::post('/deleteRoles',[ApiController::class,'deleteRole']);
    Route::post('/createPermission',[ApiController::class,'createPermission']);
});
Route::group(['middleware'=>'api','middleware'=>'api_gateway','prefix'=>'Customer'], function($router){
    Route::post('/search',[CustomerController::class,'searchCustomer']);
    Route::post('/create_customer',[CustomerController::class,'addCustomer']);
    Route::post('/create_plan',[CustomerController::class,'createPlan']);
    Route::post('/getCustomerInfo',[CustomerController::class,'getCustomerInfo']);
    Route::get('/getMenuInfo',[MenuController::class,'getMenuInfo']);
});
/* Route::middleware('api_gateway')->group(function () {
    // Define routes for different APIs
    Route::prefix('unity')->group(function () {
        Route::get('register', [ApiController::class, "register"]);
        Route::post('register', [ApiController::class, "register"]);
        Route::post('login', [ApiController::class, "login"]);
        Route::post('profile', [ApiController::class, "profile"]);
        // ...
    });

    Route::prefix('test')->group(function () {
        Route::get('resource2', 'Api2Controller@getResource2');
        // ...
    });

    // ...
}); */

/* Route::fallback(function($exception)
{
    return ["status"=>"404","msg"=>"Server Not Working"];
}); */
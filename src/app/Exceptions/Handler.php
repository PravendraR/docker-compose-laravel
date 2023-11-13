<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Database\QueryException;
use BadMethodCallException;
use Illuminate\Foundation\Bootstrap\HandleExceptions;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Spatie\Permission\Exceptions\PermissionAlreadyExists;
class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        /*
        //  This method is using for user defined error messages 
        $this->renderable(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->error(config(key:'msgconfig.handler.sourcenotfound'),404,null);
            }
        });
        // This method is using for user defined error messages 
        $this->renderable(function (ErrorException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->error(config(key:'msgconfig.handler.mothodnotfound'),404,null);
            }
        });
        $this->renderable(function (BadMethodCallException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->error(config(key:'msgconfig.handler.badmethod'),404,null);
            }
        });
        $this->renderable(function (HandleExceptions $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->error(config(key:'msgconfig.handler.badmethodcall'),401,null);
            }
        });
        $this->renderable(function (QueryException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->error(config(key:'msgconfig.handler.dbmotfound'),401,null);
            }
        });
        $this->renderable(function (PermissionDoesNotExist $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->error(config(key:'msgconfig.permissionNotFound'));
            }
        });
        $this->renderable(function (PermissionAlreadyExists $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->error(config(key:'msgconfig.permissionAlreadyExits'));
            }
        });
        $this->renderable(function (RoleDoesNotExist $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->error(config(key:'msgconfig.roleNotFound'));
            }
        });

        // This exception exicutes when if method not exits
        $this->renderable(function (MethodNotAllowedHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->error(config(key:'msgconfig.handler.mothodnotfound'),404,null);
            }
        });
        // This exception exicutes when if Route not exits
        $this->renderable(function (RouteNotFoundException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->error(config(key:'msgconfig.unauthorized'),404,null);
            }
        });
        // This method calls when duplicate user trying to register
        $this->renderable(function (UniqueConstraintViolationException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->error(config(key:'msgconfig.handler.unique'),401,null);
            }
        });*/
    }

    /* $this->renderable(function (NotFoundHttpException $e) {
        // dd($e);
        return response()->json(['message'=>'Record Not Found'],404);
    });
    $this->renderable(function (BindingResolutionException $e) {
        // dd($e);
        return response()->json(['message'=>'Page Not Found'],404);
    });
    $this->renderable(function (MethodNotAllowedHttpException $e) {

        return response()->json(['message'=>'Method Not Found'],404);
    }); */
}

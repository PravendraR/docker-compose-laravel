<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Helpers\Helper;

class ApiGatewayMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!empty($request->companyId)) {
            $CompanyId =  DB::table('tbl_company')->select('id')
                                                ->where('CompanyId', $request->companyId)
                                                ->get();
                                                
            if (count($CompanyId)) {
                $request->merge(['CompID' => $CompanyId[0]->id]);
                return $next($request);
            }
            return response()->error(config(key:'msgconfig.company_invalid'),401,null);
        }
        else{
            return response()->error(config(key:'msgconfig.company_required'),401,null);
        }

    }
}

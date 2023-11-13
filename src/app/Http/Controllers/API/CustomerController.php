<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customers;
use App\Models\Plan;
use Illuminate\Support\Facades\Hash;
use  App\Http\Helpers\Helper;
use Illuminate\Support\Facades\DB;
use Validator;
use Spatie\Permission\Models\Role;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Expr\AssignOp\Concat;

class CustomerController extends Controller
{
    //
    public $api;
    public function __construct()
    {
        $this->middleware('auth:api');
         $this->api = new ApiController;
    }

    public function getCustomerInfo(Request $request) {
        
        $ishavePermission = Helper::verifyAccess('user.list');
        if($ishavePermission){
            $newToken = $this->api->getNewToken($request); // This method invalidate given token and generate new one.
            if (!empty($newToken)) {   

                $customer = DB::table('tbl_customers as cust')
                                    ->join('tbl_enrollments as enroll', 'cust.EnrollmentId','=','enroll.id')
                                    ->join('tbl_personal_info as per','per.enrollmentId','=','enroll.id')
                                    ->join('tbl_addresses as adr','adr.enrollmentId','=','enroll.id')
                                    ->join('tbl_beneficiaries as benf','benf.enrollmentId','=','enroll.id')
                                    ->where('cust.id',$request->customerId)
                                    ->select('cust.id as CustomerID','cust.Username as AccountNumber','cust.isActive as CustStatus',
                'enroll.AcpQualifyDate','per.SecondaryPhone','benf.TribalID',
                'adr.CityID as City','adr.StateID as State','adr.ZipID as ZipCode','adr.ServiceAddress1','adr.ServiceAddress2','adr.CountryID as Country',
                'adr.MailCityID as MailCity','adr.MailStateID as MailState','adr.MailZipID as MailZip','adr.MailServiceAddress1','adr.MailServiceAddress2','adr.MailCountryID as MailCountry',
                'per.Email','per.SSN','per.DOB','per.FirstName','per.MiddleName','per.LastName')
                                    ->get();
                
                if($customer)
                {
                    $city       = DB::table('tbl_cities')->find($customer[0]->City);
                    $state      = DB::table('tbl_states')->find($customer[0]->State);
                    $zipcode    = DB::table('tbl_zip_codes')->find($customer[0]->ZipCode);
                    $country    = DB::table('tbl_countries')->find($customer[0]->Country);
                    
                    $customer[0]->City      = $city->CityName;
                    $customer[0]->State     = $state->StateName;
                    $customer[0]->ZipCode   = $zipcode->ZipCode;
                    $customer[0]->Country   = $country->CountryName;
                    
                    return response()->success(config(key: 'msgconfig.success'), $newToken, $customer);
                } 
                return response()->error(config(key: 'msgconfig.noRecordFound'), $newToken,$customer);
            }
            return response()->error(config(key: 'msgconfig.newTolenFail'),null,$ishavePermission);
        }
        return response()->error(config(key: 'msgconfig.user_access_fail'),null,$ishavePermission);
    }

    public function searchCustomer(Request $request) {
        
        /*
        for telgoo 5 requests and responses
        $gzelResp = Http::post('https://www.vcareapi.com:8080/authenticate',[
            "vendor_id"=> "Telgoo5",
            "username"=>"Telgoo5",
            "password"=>"Telgoo5",
            "pin"=> "12345678901"
        ]);
        dd(json_decode($gzelResp->body())); */
        // This is required for every mothod to check user role have access or not for this api call
        $ishavePermission = Helper::verifyAccess('user.list');
        if($ishavePermission){
            $newToken = $this->api->getNewToken($request); // This method invalidate given token and generate new one.
            if (!empty($newToken)) {         

                if (!empty($request->search)){
                    $search = gettype($request->search);
                    $customer = DB::table('tbl_enrollments as en');
                    $customer = $customer->join('tbl_customers as cs','cs.EnrollmentId','=','en.id')
                                         ->select('cs.id as customerId','en.ConsentorPhoneNumber','en.AlternateContactName','en.EnrollmentType','en.IsActive','cs.FirstName','cs.LastName','cs.EmailAddress');
                    if ($search == "string") {
                        
                        $customer = $customer->where('cs.FirstName', 'like', '%' . $request->search . '%')
                                    ->orWhere('cs.LastName', 'like', '%' . $request->search . '%')
                                    ->orWhere('cs.EmailAddress', 'like', '%' . $request->search . '%')
                                    ->orWhere('cs.Username', 'like', '%' . $request->search . '%')
                                    ->get();            
                    } else if($search == "numeric"){
                        $customer = $customer->where('en.ConsentorPhoneNumber', 'like', '%' . $request->search . '%')
                                                ->get();
                        
                    } else {
                        $customer = [];
                    }
                 }/*else {
                    if (!empty($request->firstName))
                        $customer = $customer->where('FirstName', 'like', '%' . $request->firstName . '%');

                    if (!empty($request->lastName))
                        $customer = $customer->where('LastName', 'like', '%' . $request->lastName . '%');

                    if (!empty($request->email))
                        $customer = $customer->where('EmailAddress', 'like', '%' . $request->emal . '%');

                    if (!empty($request->userName))
                        $customer = $customer->where('Username', 'like', '%' . $request->userName . '%');
                } */
                if(count($customer))
                    return response()->success(config(key: 'msgconfig.success'), $newToken, $customer);
                else
                    return response()->error(config(key: 'msgconfig.noRecordFound'), $newToken,$search);
            }
            return response()->error(config(key: 'msgconfig.newTolenFail'),null,$ishavePermission);
        }
        return response()->error(config(key: 'msgconfig.user_access_fail'),null,$ishavePermission);
    }

    public function addCustomer(Request $request)
    {
        $ishavePermission = Helper::verifyAccess('user.list');
        if ($ishavePermission) {
            $newToken = $this->api->getNewToken($request); // This method invalidate given token and generate new one.
            if (!empty($newToken)) {
                $validator = Validator::make($request->all(), [
                    'firstName' => 'required|alpha:ascii|Max:30',
                    'lastName' => 'required|alpha:ascii|Max:30',
                    'userName' => 'required|Min:8|alpha_dash:ascii|unique:tblcustomers|Max:50',
                    'email'     => 'required|email',
                    'Birthdate' => 'date',
                    'PlanId'          => 'required|numeric',
                    'UserId'        => 'required|numeric',
                ]);

                if ($validator->fails()) {
                    return response()->error(config(key: 'msgconfig.user_status'), null, $validator->errors());
                }
                $query = [
                    'FirstName' => $request->firstName,
                    'LastName' => $request->lastName,
                    'Username' => $request->userName,
                    'EmailAddress' => $request->email,
                    'PlanId' => $request->PlanId,
                    'UserId' => $request->UserId,
                    'City' => $request->City,
                    'State' => $request->State,
                    'PostalCode' => $request->PostalCode,
                    'CreatedBy' => 1,
                    'UpdatedBy' => 1,
                ];
                $customer = Customers::create($query);

                return response()->success(config(key: 'msgconfig.success'), null, $customer);
            }
            return response()->error(config(key: 'msgconfig.newTolenFail'), null, $ishavePermission);
        } else {
            return response()->error(config(key: 'msgconfig.user_access_fail'), null, $ishavePermission);
        }
    }

    public function createPlan(Request $request)
    {
        $ishavePermission = Helper::verifyAccess('user.list');
        if ($ishavePermission) {
            $newToken = $this->api->getNewToken($request); // This method invalidate old token and generate new one.
            if (!empty($newToken)) {
                $validator = Validator::make($request->all(), [
                    'planName'          => 'required|string|Max:100',
                    'planCode'          => 'required|alpha_dash:ascii|Max:5',
                    'price'             => 'decimal:0,2',
                    'planTypeId'        => 'required|numeric',
                ]);

                if ($validator->fails()) {
                    return response()->error(config(key: 'msgconfig.validation'), $newToken, $validator->errors());
                }
                $createdBy = auth()->user()->id;
                $query = [
                    'Name'          => $request->planName,
                    'code'          => $request->planCode,
                    'Description'   => $request->planDescription,
                    'Price'         => $request->price,
                    'PlanTypeId'    => $request->planTypeId,
                    'IsActive'      => 1,
                    'IsDeleted'     => 0,
                    'CreatedBy'     => $createdBy,
                    'UpdatedBy'     => $createdBy
                    
                ];
                $plan = Plan::create($query);

                return response()->success(config(key: 'msgconfig.success'), $newToken, $plan);
            }
            return response()->error(config(key: 'msgconfig.newTolenFail'), null, $ishavePermission);
        } else {
            return response()->error(config(key: 'msgconfig.user_access_fail'), null, $ishavePermission);
        }
    }


}
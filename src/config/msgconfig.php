<?php
return [
    'success' => ['Success',200,'API000'],
    'login_success' => ['You are logged in.',200,'API000'],
    'login_fails' => ['Login fails.',401,'API001'],
    'company_required' => ['Company Id is required',401,'API001'],
    'company_invalid' => ['Company Id does not belogs.',401,'API001'],
    'unathorized'=>['Authontication Failed',401,'API001'],
    'newTolenFail'=>['Error Occured in token generation',401,'API001'],
    'registered'=>['User is already registered',200,'API004'],
    'unregistered'=>['User not registered',200,'API004'],
    'user_status'=>['Internal user status error',422,'API001'],
    'user_access_fail'=>['User not authorized to access.',422,'API001'],
    'validation'=>['Validation errors',422,'API000'],
    'noRecordFound'=>['No record found',200,'API004'],
    'permissionNotFound'=>['Permission name does not exits',200,'API004'],
    'permissionAlreadyExits'=>['Permission name already exits',200,'API004'],
    'roleNotFound'=>['Role name does not exits',200,'API004'],
    
    'name'=>'Name is required',
    'email'=>[
        'required'=>'Email is required',
        'Unique'=>'User is already Registed with us..',
        'Max'=>'Email addredss should not be more than 25 characters',
        ],
    'userId'=>[
        'required'=>'User Id should be filled',
        'Unique'=>'User is already registered with us..',
        'Min'=>'UserId should not be less than 5 characters',
        ],
    'password'=>'Password is required',
    'unique'=>'User already regestered',
    'Min'=>':attribute is required',
    'wrongAuthId'=>'Invalid VendorID',
    'login'=>'Login Successfully',
    

    'handler'=>[
        'sourcenotfound'=>['Source not found',401,'API004'],
        'badmethod'=>'Bad Method not found',
        'mothodnotfound'=>'Method not found',
        'dbmotfound'=>'Database not found',
        'badmethodcall'=>'Bad Method Call'
    ]
    ];

?>
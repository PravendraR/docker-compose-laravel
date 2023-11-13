<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Traits\HasRoles;

class Plan extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    const CREATED_AT = 'CreatedDate';
    const UPDATED_AT = 'UpdatedDate';
    
    protected $table = 'tbl_plans';
    protected $fillable = [
        'Name'         ,
        'code'         ,
        'Description'  ,
        'Price'        ,
        'PlanTypeId'   ,
        'IsActive'     ,
        'IsDeleted'    ,
        'CreatedBy'    ,
        'UpdatedBy'    ,
        
    ];
}

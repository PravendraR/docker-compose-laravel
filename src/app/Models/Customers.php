<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Traits\HasRoles;

class Customers extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'FirstName',
        'LastName',
        'Username',
        'EmailAddress',
        'Birthdate',
        'SsnNo',
        'DriversLicenseId',
        'MilitaryId',
        'PassportNo',
        'TaxPayerCode',
        'OtherGovernmentId',
        'ServiceAddress1',
        'ServiceAddress2',
        'ServiceAddressUnit1',
        'ServiceAddressUnit2',
        'City',
        'State',
        'PostalCode',
        'SuffixName',
        'PlanId',
        'UserId',
        'CreatedBy',
        'UpdatedBy',
    ];
    const CREATED_AT = 'CreatedDate';
    const UPDATED_AT = 'UpdatedDate';
    
    protected $table = 'tbl_customers';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
       
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     * 
     * 
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
        // 'password' => 'hashed',
    ];

    public function getJWTIdentifier()
    {
      return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
      return [];
    }
    
}

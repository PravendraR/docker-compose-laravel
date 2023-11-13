<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Traits\HasRoles;

class Menu extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    
    protected $table = 'tbl_menus';
    protected $fillable = [
        'parentId','Descripton','urlRoute','params','isActive','navIconClass','hideMenu','sortOrder','CreatedDate','CreatedBy','UpdatedDate','UpdatedBy'
    ];
}

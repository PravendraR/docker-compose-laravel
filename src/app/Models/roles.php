<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Roles extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    const CREATED_AT = 'CreatedDate';
    const UPDATED_AT = 'UpdatedDate';
    protected $fillable = [
        'name',
        'guard_name',
    ];
}

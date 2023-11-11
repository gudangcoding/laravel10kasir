<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Member extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'member';
    protected $primaryKey = 'id_member';
    protected $guarded = [];

    protected $hidden = [
        'password',
        'c_password',
    ];

    // protected $casts = [
    //     'password' => 'hashed',
    // ];
}

<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $hidden = ['updated_at'];

    protected $casts = [
        'created_at' => 'date:Y-m-d',
    ];

    protected $fillable = [
        'provider', 
        'amount', 
        'currency', 
        'email', 
        'status_code', 
        'provider_id', 
        'created_at',
    ];
}

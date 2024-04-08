<?php

namespace App\Models;
// use this doc for different login using different table
// https://pusher.com/tutorials/multiple-authentication-guards-laravel/#define-the-guards

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

        protected $guard = 'admin';

        protected $fillable = [
            'name', 'email', 'password',
        ];

        protected $hidden = [
            'password', 'remember_token',
        ];
}

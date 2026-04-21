<?php 

namespace App\Models;


class User extends BaseModel
{
    protected static $table = 'users';

    protected static $fillable = [
        'first_name', 
        'last_name', 
        'username', 
        'email', 
        'password', 
        'birthdate'
    ];

}
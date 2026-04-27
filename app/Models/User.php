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

    protected static $hidden = [
        'password',
    ];

   public static function insert($data)
    {
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        return parent::insert($data);
    }
}
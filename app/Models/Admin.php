<?php


namespace App\Models;

class Admin extends BaseModel
{
    //Declaration of table name
    protected static $table = 'admins';

    protected static $fillable = [
        'user_id',
        'role',
        'is_active',
        'last_login'
    ];

    public static function adminWithUsers()
    {
        /**
         * Because we use Option 1, we manually prefix the columns 
         * with 'u.' to tell MySQL they belong to the 'users' table.
         */
        return self::belongsTo(
            'users',
            'user_id',
            'u.first_name, u.last_name, u.email, u.username'
        );
    }

}
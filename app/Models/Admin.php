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

    public static function findWithUser($id)
    {
        self::init();

        $sql = "SELECT 
                u.first_name, u.last_name, u.username, u.email, u.birthdate, u.created_at,
                a.id, a.role, a.is_active, a.last_login
            FROM admins a
            JOIN users u ON a.user_id = u.id
            WHERE a.id = :id 
            LIMIT 1";

        $stmt = self::$db->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result ? $result : null;
    }


}
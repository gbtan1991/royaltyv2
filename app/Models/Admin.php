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


    public static function getAll() 
    {
        self::init();
        
        $sql = "SELECT 
                a.id, 
                a.role, 
                a.is_active, 
                a.last_login,
                u.first_name, 
                u.last_name, 
                u.username, 
                u.email
              FROM admins a
              JOIN users u ON a.user_id = u.id
              ORDER BY u.last_name ASC";


        $stmt = self::$db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }

    
    
}
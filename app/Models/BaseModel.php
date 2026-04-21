<?php


namespace App\Models;


use App\Core\Database;
use PDO;


abstract class BaseModel
{
    protected static $db;
    protected static $table;
    protected static $fillable = [];

    protected static function init()
    {
        if(!self::$db) {
            self::$db = Database::getConnection();
        }
    }

    // START COMMON CRUD METHODS - Can be overridden in child Models if needed

    // READ METHODS

    // This queries all of the data in the database for the given model.
    public static function all()
    {
        self::init();
        $stmt = self::$db->query("SELECT * FROM " . static::$table . " ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // This finds a single record by ID.
    public static function find($id)
    {
        self::init();
        $stmt = self::$db->prepare("SELECT * FROM " . static::$table . " WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // This inserts a new record into the databaase.
    public static function insert($data)
    {
        self::init();
        $filteredData = array_intersect_key($data, array_flip(static::$fillable));
        $columns = implode(', ', array_keys($filteredData));
        $placeholders = ':' . implode(', :', array_keys($filteredData));

        $sql = "INSERT INTO " . static::$table . " ($columns) VALUES ($placeholders)";
        $stmt = self::$db->prepare($sql);
        $stmt->execute($filteredData);
        return self::$db->lastInsertId();
    }

    // This updates an existing record in the database.
    public static function update($id, $data)
    {
        self::init();
        $filteredData = array_intersect_key($data, array_flip(static::$fillable));
        $setClause = implode(', ', array_map(fn($col) => "$col = :$col", array_keys($filteredData)));

        $sql = "UPDATE " . static::$table . " SET $setClause WHERE id = :id";
        $filteredData['id'] = $id;
        $stmt = self::$db->prepare($sql);
        return $stmt->execute($filteredData);
    }


    // This deletes a record from the database.
    public static function delete($id)
    {
        self::init();
        $sql = "DELETE FROM " . static::$table . " WHERE id = :id";
        $stmt = self::$db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    public static function withJoin($joinTable, $foreignKey, $joinColumns = "*")
    {
        $mainAlias = substr(static::$table, 0, 1); // e.g., 'u' for 'users'
        $joinAlias = substr($joinTable, 0, 1); // e.g., 'a' for 'admins'

        self::init();
        $sql = "SELECT $mainAlias.*, $joinAlias.$joinColumns 
                FROM " . static::$table . " $mainAlias
                JOIN $joinTable $joinAlias ON $mainAlias.id = $joinAlias.$foreignKey
                WHERE $mainAlias.id = :id";

        $stmt = self::$db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
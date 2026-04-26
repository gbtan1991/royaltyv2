<?php


namespace App\Models;


use App\Core\Database;
use Exception;
use PDO;


abstract class BaseModel
{
    protected static $db;
    protected static $table;
    protected static $fillable = [];

    protected static function init()
    {
        if (!self::$db) {
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

    public static function transaction(callable $callback)
    {
        self::init();
        try{
            self::$db->beginTransaction();

            // Execute the callback
            $result = $callback();

            self::$db->commit();
            return $result;
        } catch (Exception $e) {
            // If anything fails inside the callback,  we rollback the transaction
            if (self::$db->inTransaction()) {
                self::$db->rollBack();
            }
            // Re-throw the exception so it can be handled by the caller
            throw $e;
            
        }

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

    public static function belongsTo($parentTable, $foreignKey, $columns = '*')
    {
        self::init();

        // Create aliases based on the first letter of the table names
        $child = substr(static::$table, 0, 1);
        $parent = substr($parentTable, 0, 1);

        // Prevent collision if both tables start with the same letter
        if ($child === $parent) {
            $parent = 'p';
        }

        /**
         * Logic: We select all from child ($child.*) 
         * and specifically what you requested from parent ($columns)
         */
        $sql = "SELECT $child.*, $columns 
            FROM " . static::$table . " $child
            JOIN $parentTable $parent ON $child.$foreignKey = $parent.id";

        $stmt = self::$db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function hasOne($childTable, $foreignKey, $columns = '*')
    {
        self::init();
        $parent = substr(static::$table, 0, 1);
        $child = substr($childTable, 0, 1);
        if ($parent === $child) {
            $child = 'c';
        }

        $sql = "SELECT $parent.*, $child.$columns 
            FROM " . static::$table . " $parent
            JOIN $childTable $child ON $parent.id = $child.$foreignKey";

        $stmt = self::$db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function hasMany($childTable, $foreignKey, $columns = '*')
{
    self::init();
    $parent = substr(static::$table, 0, 1);
    $child = substr($childTable, 0, 1);

        if ($parent === $child) {
        $child = 'c';
    }

    // We use $columns directly to allow for flexibility
    $sql = "SELECT $parent.*, $columns 
            FROM " . static::$table . " $parent
            LEFT JOIN $childTable $child ON $parent.id = $child.$foreignKey";

    $stmt = self::$db->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
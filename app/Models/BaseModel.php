<?php

namespace App\Models;

use App\Core\Database;
use PDO;

abstract class BaseModel
{
        protected $db;
        protected $table;

        public function __construct()
        {
            $this->db = Database::getConnection();
        }

    // Get everything from the table
    public function all()
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll();
    }

    // Find a specific record by ID
    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
    
    // You can later add methods like create(), update(), delete() here
}
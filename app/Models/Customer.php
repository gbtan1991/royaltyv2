<?php

namespace App\Models;

class Customer extends BaseModel
{
    // The BaseModel will use this to know which table to query
    protected $table = 'customer';

    /**
     * Custom method to get top customers based on points
     */
    public function getTopHolders($limit = 10)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} ORDER BY total_points DESC LIMIT :limit");
        $stmt->bindValue(':limit', (int) $limit, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
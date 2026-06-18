<?php

namespace App\Models;

class Household extends Model {
    public function all() {
        $stmt = $this->db->prepare("
            SELECT *
            FROM households
            WHERE status = 'active'
            ORDER BY household_no ASC
        ");

        $stmt->execute();

        return $stmt->fetchAll();
    }
}
<?php

namespace App\Models;

class Household extends Model {
    public function all() {
        $stmt = $this->db->prepare("
            SELECT
                households.*,
                COUNT(residents.id) AS resident_count,
                head.first_name AS head_first_name,
                head.middle_name AS head_middle_name,
                head.last_name AS head_last_name,
                head.suffix AS head_suffix
            FROM households
            LEFT JOIN residents
                ON residents.household_id = households.id
                AND residents.status = 'active'
            LEFT JOIN residents AS head
                ON households.head_resident_id = head.id
            WHERE households.status = 'active'
            GROUP BY households.id
            ORDER BY households.household_no ASC
        ");

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO households (
                household_no,
                head_resident_id,
                purok,
                sitio,
                street,
                house_no,
                address,
                household_type,
                monthly_income
            ) VALUES (
                :household_no,
                :head_resident_id,
                :purok,
                :sitio,
                :street,
                :house_no,
                :address,
                :household_type,
                :monthly_income
            )
        ");

        return $stmt->execute($data);
    }

    public function find($id) {
        $stmt = $this->db->prepare("
            SELECT *
            FROM households
            WHERE id = :id
            AND status = 'active'
            LIMIT 1
        ");

        $stmt->execute([
            'id' => $id
        ]);

        return $stmt->fetch();
    }

    public function residents($householdId) {
        $stmt = $this->db->prepare("
            SELECT id, first_name, middle_name, last_name, suffix
            FROM residents
            WHERE household_id = :household_id
            AND status = 'active'
            ORDER BY last_name ASC, first_name ASC
        ");

        $stmt->execute([
            'household_id' => $householdId
        ]);

        return $stmt->fetchAll();
    }

    public function update($id, $data) {
        $data['id'] = $id;

        $stmt = $this->db->prepare("
            UPDATE households SET
                household_no = :household_no,
                head_resident_id = :head_resident_id,
                purok = :purok,
                sitio = :sitio,
                street = :street,
                house_no = :house_no,
                address = :address,
                household_type = :household_type,
                monthly_income = :monthly_income
            WHERE id = :id
            AND status = 'active'
        ");

        return $stmt->execute($data);
    }
}
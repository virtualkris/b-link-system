<?php

namespace App\Models;

class Document extends Model {
    public function all() {
        $stmt = $this->db->prepare("
            SELECT
                documents.*,
                residents.first_name,
                residents.middle_name,
                residents.last_name,
                residents.suffix,
                users.name AS issued_by_name
            FROM documents
            INNER JOIN residents ON documents.resident_id = residents.id
            LEFT JOIN users ON documents.issued_by = users.id
            WHERE documents.status = 'generated'
            ORDER BY documents.issued_at DESC
        ");

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function find($id) {
        $stmt = $this->db->prepare("
            SELECT
                documents.*,
                residents.first_name,
                residents.middle_name,
                residents.last_name,
                residents.suffix,
                residents.gender,
                residents.birthdate,
                residents.civil_status,
                residents.occupation,
                households.purok,
                households.address AS household_address,
                users.name AS issued_by_name
            FROM documents
            INNER JOIN residents ON documents.resident_id = residents.id
            LEFT JOIN households ON residents.household_id = households.id
            LEFT JOIN users ON documents.issued_by = users.id
            WHERE documents.id = :id
            LIMIT 1
        ");

        $stmt->execute([
            'id' => $id
        ]);

        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO documents (
                resident_id,
                issued_by,
                document_type,
                control_no,
                purpose,
                content
            ) VALUES (
                :resident_id,
                :issued_by,
                :document_type,
                :control_no,
                :purpose,
                :content 
            )
        ");

        $stmt->execute($data);

        return $this->db->lastInsertId();
    }
}
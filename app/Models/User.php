<?php

namespace App\Models;

class User extends Model {
    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");

        $stmt->execute([
            'email' => $email
        ]);

        return $stmt->fetch();
    }
}
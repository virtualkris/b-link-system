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

    public function all() {
        $stmt = $this->db->prepare("
            SELECT id, name, email, role, created_at
            FROM users
            ORDER BY created_at DESC
        ");

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO users (
                name,
                email,
                password,
                role
            ) VALUES (
                :name,
                :email,
                :password,
                :role
            )
        ");

        return $stmt->execute($data);
    }
}
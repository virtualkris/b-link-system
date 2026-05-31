<?php

namespace App\Models;

use App\Config\Database;

abstract class Model {
    protected $db;

    public function __construct() {
        $this->db = Database::connect();
    }
}
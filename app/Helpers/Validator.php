<?php

namespace App\Helpers;

class Validator {
    public static function required($data, $fields) {
        $errors = [];

        foreach ($fields as $field => $label) {
            if (!isset($data[$field]) || trim($data[$field]) === '') {
                $errors[$field] = "{$label} is required.";
            }
        }

        return $errors;
    }

    public static function in($data, $field, $allowed, $label) {
        if (!empty($data[$field]) && !in_array($data[$field], $allowed)) {
            return [
                $field => "{$label} is invalid."
            ];
        }

        return [];
    }

    public static function date($data, $field, $label) {
        if (empty($data[$field])) {
            return [];
        }

        $date = \DateTime::createFromFormat('Y-m-d', $data[$field]);

        if (!$date || $date->format('Y-m-d') !== $data[$field]) {
            return [
                $field => "{$label} must be a valid date."
            ];
        }

        return [];
    }
}
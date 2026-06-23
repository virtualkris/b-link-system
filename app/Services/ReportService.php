<?php

namespace App\Services;

use App\Config\Database;

class ReportService {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function dashboardStats() {
        return [
            'total_residents' => $this->countActiveResidents(),
            'total_households' => $this->countActiveHouseholds(),
            'total_documents' => $this->countGeneratedDocuments(),
            'senior_citizens' => $this->countByFlag('sector_senior_citizen'),
            'minors' => $this->countByFlag('is_minor'),
            'pwd' => $this->countByFlag('sector_pwd'),
            'out_of_school_youth' => $this->countByFlag('sector_out_of_school_youth'),
            'male' => $this->countByGender('male'),
            'female' => $this->countByGender('female'),
            'active_disaster_reports' => $this->countActiveDisasterReports(),
            'total_affected_households' => $this->sumAffectedHouseholds(),
            'total_affected_residents' => $this->sumAffectedResidents(),
            'critical_evacuation_priority' => $this->countEvacuationPriority('critical'),
            'high_evacuation_priority' => $this->countEvacuationPriority('high'),
        ];
    }

    private function countActiveResidents() {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) AS total
            FROM residents
            WHERE status = 'active'
        ");

        $stmt->execute();

        return $stmt->fetch()['total'];
    }

    private function countActiveHouseholds() {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) AS total
            FROM households
            WHERE status = 'active'
        ");

        $stmt->execute();

        return $stmt->fetch()['total'];
    }

    private function countGeneratedDocuments() {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) AS total
            FROM documents
            WHERE status = 'generated'
        ");

        $stmt->execute();

        return $stmt->fetch()['total'];
    }

    private function countByFlag($column) {
        $allowedColumns = [
            'sector_senior_citizen',
            'is_minor',
            'sector_pwd',
            'sector_out_of_school_youth'
        ];

        if (!in_array($column, $allowedColumns)) {
            return 0;
        }

        $stmt = $this->db->prepare("
            SELECT COUNT(*) AS total
            FROM residents
            WHERE status = 'active'
            AND {$column} = 1
        ");

        $stmt->execute();

        return $stmt->fetch()['total'];
    }

    private function countByGender($gender) {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) AS total
            FROM residents
            WHERE status = 'active'
            AND gender = :gender
        ");

        $stmt->execute([
            'gender' => $gender
        ]);

        return $stmt->fetch()['total'];
    }

    private function countActiveDisasterReports() {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) AS total
            FROM disaster_reports
            WHERE status != 'resolved'
        ");

        $stmt->execute();
        
        return $stmt->fetch()['total'];
    }

    private function sumAffectedHouseholds() {
        $stmt = $this->db->prepare("
            SELECT COALESCE(SUM(affected_households), 0) AS total
            FROM disaster_reports
            WHERE status != 'resolved'
        ");

        $stmt->execute();

        return $stmt->fetch()['total'];
    }

    private function sumAffectedResidents() {
        $stmt = $this->db->prepare("
            SELECT COALESCE(SUM(affected_residents), 0) AS total
            FROM disaster_reports
            WHERE status != 'resolved'
        ");

        $stmt->execute();

        return $stmt->fetch()['total'];
    }

    private function countEvacuationPriority($priority) {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) AS total
            FROM residents
            WHERE status = 'active'
            AND evacuation_priority = :priority
        ");

        $stmt->execute([
            'priority' => $priority
        ]);

        return $stmt->fetch()['total'];
    }
}
<?php

namespace App\Services;

use App\Config\Database;

class DisasterService {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function filterResidents($filters) {
        $sql = "
            SELECT
                residents.*,
                households.household_no,
                households.purok,
                households.address
            FROM residents
            LEFT JOIN households ON residents.household_id = households.id
            WHERE residents.status = 'active'
        ";

        $params = [];

        if (!empty($filters['category'])) {
            if ($filters['category'] === 'seniors') {
                $sql .= " AND residents.sector_senior_citizen = 1";
            }

            if ($filters['category'] === 'minors') {
                $sql .= " AND residents.is_minor = 1";
            }

            if ($filters['category'] === 'pwd') {
                $sql .= " AND residents.sector_pwd = 1";
            }

            if ($filters['category'] === 'solo_parent') {
                $sql .= " AND residents.sector_solo_parent = 1";
            }

            if ($filters['category'] === 'out_of_school_youth') {
                $sql .= " AND residents.sector_out_of_school_youth = 1";
            }

            if ($filters['category'] === 'pregnant') {
                $sql .= " AND residents.is_pregnant = 1";
            }

            if ($filters['category'] === 'lactating_mother') {
                $sql .= " AND residents.is_lactating_mother = 1";
            }

            if ($filters['category'] === 'bedridden') {
                $sql .= " AND residents.is_bedridden = 1";
            }

            if ($filters['category'] === '4ps_member') {
                $sql .= " AND residents.sector_4ps_member = 1";
            }
        }

        if (!empty($filters['purok'])) {
            $sql .= " AND households.purok = :purok";
            $params['purok'] = $filters['purok'];
        }

        if(!empty($filters['gender'])) {
            $sql .= " AND residents.gender = :gender";
            $params['gender'] = $filters['gender'];
        }

        $sql .= " ORDER BY households.purok ASC, residents.last_name ASC, residents.first_name ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    public function getPuroks() {
        $stmt = $this->db->prepare("
            SELECT DISTINCT purok
            FROM households
            WHERE status = 'active'
            AND purok IS NOT NULL
            AND purok != ''
            ORDER BY purok ASC
        ");

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function householdCountsByPurok() {
        $stmt = $this->db->prepare("
            SELECT
                purok,
                COUNT(*) AS household_count
            FROM households
            WHERE status = 'active'
            GROUP BY purok
            ORDER BY purok ASC
        ");

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getDisasterReports($statusFilter = 'active') {
        $sql = "
            SELECT
                disaster_reports.*,
                users.name AS reported_by_name
            FROM disaster_reports
            LEFT JOIN users ON disaster_reports.reported_by = users.id
        ";

        $params = [];

        if ($statusFilter === 'active') {
            $sql .= " WHERE disaster_reports.status != 'resolved'";
        }

        if ($statusFilter === 'resolved') {
            $sql .= " WHERE disaster_reports.status = 'resolved'";
        }

        $sql .= " ORDER BY disaster_reports.report_date DESC, disaster_reports.created_at DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    public function createDisasterReport($data) {
        $stmt = $this->db->prepare("
            INSERT INTO disaster_reports (
                disaster_name,
                purok,
                report_date,
                affected_households,
                affected_residents,
                status,
                remarks,
                reported_by
            ) VALUES (
                :disaster_name,
                :purok,
                :report_date,
                :affected_households,
                :affected_residents,
                :status,
                :remarks,
                :reported_by 
            )
        ");

        return $stmt->execute($data);
    }

    public function updateDisasterReportStatus($id, $status) {
        $allowedStatuses = [
            'monitoring',
            'evacuating',
            'relief_distributed',
            'resolved'
        ];

        if (!in_array($status, $allowedStatuses)) {
            return false;
        }

        $stmt = $this->db->prepare("
            UPDATE disaster_reports
            SET status = :status
            WHERE id = :id
        ");

        return $stmt->execute([
            'id' => $id,
            'status' => $status
        ]);
    }
}
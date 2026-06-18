<?php

namespace App\Models;

class Resident extends Model {
    public function all() {
        $stmt = $this->db->prepare("
            SELECT
                residents.*,
                households.household_no,
                households.purok,
                households.address
            FROM residents
            LEFT JOIN households ON residents.household_id = households.id
            WHERE residents.status = 'active'
            ORDER BY residents.last_name ASC, residents.first_name ASC    
            ");

            $stmt->execute();

            return $stmt->fetchAll();
    }
    
    public function search($keyword) {
        $keyword = "%{$keyword}%";

        $stmt = $this->db->prepare("
            SELECT
                residents.*,
                households.household_no,
                households.purok,
                households.address
            FROM residents
            LEFT JOIN households ON residents.household_id = households.id
            WHERE residents.status = 'active'
            AND (
                residents.first_name LIKE :keyword
                OR residents.middle_name LIKE :keyword
                OR residents.last_name LIKE :keyword
                OR residents.contact_number LIKE :keyword
                OR residents.voter_status LIKE :keyword
                OR households.household_no LIKE :keyword
                OR households.purok LIKE :keyword
            )
            ORDER BY residents.last_name ASC, residents.first_name ASC
        ");

        $stmt->execute([
            'keyword' => $keyword
        ]);

        return $stmt->fetchAll();
    }

    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO residents (
                household_id,
                first_name,
                middle_name,
                last_name,
                suffix,
                gender,
                birthdate,
                birthplace,
                civil_status,
                nationality,
                religion,
                contact_number,
                email,
                occupation,
                educational_attainment,
                voter_status,
                precinct_no,
                sector_senior_citizen,
                sector_pwd,
                sector_solo_parent,
                sector_indigenous_people,
                sector_4ps_member,
                sector_out_of_school_youth,
                is_minor,
                is_pregnant,
                is_lactating_mother,
                is_bedridden,
                emergency_contact_name,
                emergency_contact_number
            ) VALUES (
                :household_id,
                :first_name,
                :middle_name,
                :last_name,
                :suffix,
                :gender,
                :birthdate,
                :birthplace,
                :civil_status,
                :nationality,
                :religion,
                :contact_number,
                :email,
                :occupation,
                :educational_attainment,
                :voter_status,
                :precinct_no,
                :sector_senior_citizen,
                :sector_pwd,
                :sector_solo_parent,
                :sector_indigenous_people,
                :sector_4ps_member,
                :sector_out_of_school_youth,
                :is_minor,
                :is_pregnant,
                :is_lactating_mother,
                :is_bedridden,
                :emergency_contact_name,
                :emergency_contact_number
            )
        ");

        return $stmt->execute($data);
    }

    public function find($id) {
        $stmt = $this->db->prepare("
            SELECT
                residents.*,
                households.household_no,
                households.purok,
                households.sitio,
                households.street,
                households.house_no,
                households.address
            FROM residents
            LEFT JOIN households ON residents.household_id = households.id
            WHERE residents.id = :id
            AND residents.status = 'active'
            LIMIT 1
        ");

        $stmt->execute([
            'id' => $id
        ]);

        return $stmt->fetch();
    }

    public function update($id, $data) {
        $data['id'] = $id;

        $stmt = $this->db->prepare("
            UPDATE residents SET
                household_id = :household_id,
                first_name = :first_name,
                middle_name = :middle_name,
                last_name = :last_name,
                suffix = :suffix,
                gender = :gender,
                birthdate = :birthdate,
                birthplace = :birthplace,
                civil_status = :civil_status,
                nationality = :nationality,
                religion = :religion,
                contact_number = :contact_number,
                email = :email,
                occupation = :occupation,
                educational_attainment = :educational_attainment,
                voter_status = :voter_status,
                precinct_no = :precinct_no,
                sector_senior_citizen = :sector_senior_citizen,
                sector_pwd = :sector_pwd,
                sector_solo_parent = :sector_solo_parent,
                sector_indigenous_people = :sector_indigenous_people,
                sector_4ps_member = :sector_4ps_member,
                sector_out_of_school_youth = :sector_out_of_school_youth,
                is_minor = :is_minor,
                is_pregnant = :is_pregnant,
                is_lactating_mother = :is_lactating_mother,
                is_bedridden = :is_bedridden,
                emergency_contact_name = :emergency_contact_name,
                emergency_contact_number = :emergency_contact_number
            WHERE id = :id
            AND status = 'active'
        ");

        return $stmt->execute($data);
    }

    public function archive($id) {
        $stmt = $this->db->prepare("
            UPDATE residents
            SET status = 'archived'
            WHERE id = :id
        ");

        return $stmt->execute([
            'id' => $id
        ]);
    }
    
}
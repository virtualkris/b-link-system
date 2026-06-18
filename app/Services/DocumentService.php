<?php

namespace App\Services;

class DocumentService {
    public function generateContent($documentType, $resident, $purpose = null) {
        $fullName = $this->formatResidentName($resident);
        $address = $resident['household_address'] ?? $resident['address'] ?? 'this barangay';
        $purposeText = $purpose ?: 'legal and official purposes';

        if ($documentType === 'barangay_clearance') {
            return "This is to certify that {$fullName}, of {$address}, is a resident of this barangay and, based on available records, has no derogatory record filed in this office. This certification is issued upon request for {$purposeText}.";
        }

        if ($documentType === 'certificate_of_residency') {
            return "This is to certify that {$fullName} is a bona fide resident of {$address}. This certification is issued upon request for {$purposeText}.";
        }

        if ($documentType === 'indigency_certificate') {
            return "This is to certify that {$fullName}, of {$address}, is known to this barangay and may be considered eligible for assistance based on barangay records. This certification is issued upon request for {$purposeText}.";
        }

        return "Unsupported document type.";
    }

    public function generateControlNo() {
        return 'DOC-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
    }

    private function formatResidentName($resident) {
        $parts = [
            $resident['first_name'] ?? '',
            $resident['middle_name'] ?? '',
            $resident['last_name'] ?? '',
            $resident['suffix'] ?? ''
        ];

        $parts = array_filter($parts);

        return implode(' ', $parts);
    }
}
<?php

namespace App\Controllers;

use App\Models\Document;
use App\Models\Resident;
use App\Services\DocumentService;

class DocumentController extends Controller {
    public function index() {
        $this->requireAuth();

        $documentModel = new Document();
        $documents = $documentModel->all();

        return $this->render('documents/index', [
            'title' => 'Documents',
            'documents' => $documents
        ]);
    }

    public function create() {
        $this->requireAuth();

        $residentModel = new Resident();
        $residents = $residentModel->all();

        return $this->render('documents/create', [
            'title' => 'Generate Document',
            'residents' => $residents
        ]);
    }

    public function store() {
        $this->requireAuth();

        $residentId = $_POST['resident_id'] ?? null;
        $documentType = $_POST['document_type'] ?? null;
        $purpose = $_POST['purpose'] ?? null;

        $allowedTypes = [
            'barangay_clearance',
            'certificate_of_residency',
            'indigency_certificate'
        ];

        if (empty($residentId) || empty($documentType) || !in_array($documentType, $allowedTypes)) {
            $_SESSION['error'] = 'Please select a resident and a valid document type.';
            redirect('documents/create');
        }

        $residentModel = new Resident();
        $resident = $residentModel->find($residentId);

        if (!$resident) {
            $_SESSION['error'] = 'Selected resident was not found.';
            redirect('documents/create');
        }

        $documentService = new DocumentService();

        $content = $documentService->generateContent($documentType, $resident, $purpose);
        $controlNo = $documentService->generateControlNo();

        $documentModel = new Document();

        $documentId = $documentModel->create([
            'resident_id' => $residentId,
            'issued_by' => $_SESSION['user']['id'] ?? null,
            'document_type' => $documentType,
            'control_no' => $controlNo,
            'purpose' => $purpose,
            'content' => $content
        ]);

        $_SESSION['success'] = 'Document generated successfully.';
        redirect('documents/' . $documentId . '/print');
    }

    public function print($id) {
        $this->requireAuth();

        $documentModel = new Document();
        $document = $documentModel->find($id);

        if (!$document) {
            http_response_code(404);
            echo 'Document not found.';
            exit;
        }

        return $this->render('documents/print', [
            'title' => 'Print Document',
            'document' => $document
        ]);
    }
}
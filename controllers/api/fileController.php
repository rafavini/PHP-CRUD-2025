<?php
require_once __DIR__ . '/../../Core/helper.php';
require_once __DIR__ . '/../../components/alerts.php';
require_once __DIR__ . '/../../models/fileModel.php';


class fileController
{
    private $fileModel;

    public function __construct()
    {
        $this->fileModel = new FileModel();
    }

    public function createFile()
    {
        if (isset($_POST['csrfToken'])) {
            validateTokenCsrf($_POST['csrfToken']);
            // print_r($_FILES);
            $result = $this->fileModel->createFile();
            echo json_encode(['arquivos' => $result]);
        } else {
            setToast("Acesso negado. Faça login para continuar.", "error");
            echo json_encode(['error' => 'Invalid request method or missing CSRF token']);
            exit;
        }
    }
}

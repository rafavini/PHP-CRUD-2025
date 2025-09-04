<?php
require_once __DIR__ . "/../Core/database.php";
require_once __DIR__ . "/../Core/helper.php";
require_once __DIR__ . "/../components/alerts.php";
class FileModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }


    public function getAllFiles()
    {
        $userId = $_SESSION['userAuth']['id'];

        $this->db->query("SELECT * FROM files WHERE user_id = :user_id ORDER BY criado_em DESC");
        $this->db->bind(':user_id', $userId);
        $this->db->execute();
        $result = $this->db->results();

        return $result;
    }

    public function addFile()
    {
        $userId = $_SESSION['userAuth']['id'];
        $uploadDir = __DIR__ . "/../storage/$userId/";

        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $resultados = [];

        foreach ($_FILES['arquivo']['name'] as $key => $nomeOriginal) {
            $tmpName = $_FILES['arquivo']['tmp_name'][$key];
            $tipo = $_FILES['arquivo']['type'][$key];
            $tamanho = $_FILES['arquivo']['size'][$key];

            // Nome único para evitar sobrescrita
            $ext = pathinfo($nomeOriginal, PATHINFO_EXTENSION);
            $nomeUnico = uniqid() . "." . $ext;

            $destino = $uploadDir . $nomeUnico;
            $caminhoBanco = "storage/$userId/$nomeUnico";

            if (move_uploaded_file($tmpName, $destino)) {
                $this->db->query("INSERT INTO files (user_id, nome_original, nome_interno, tamanho, tipo, caminho)
                                  VALUES (:user_id, :nome_original, :nome_interno, :tamanho, :tipo, :caminho)");
                $this->db->bind(':user_id', $userId);
                $this->db->bind(':nome_original', $nomeOriginal);
                $this->db->bind(':nome_interno', $nomeUnico);
                $this->db->bind(':tamanho', $tamanho);
                $this->db->bind(':tipo', $tipo);
                $this->db->bind(':caminho', $caminhoBanco);
                $this->db->execute();

                $resultados[] = [
                    'arquivo' => $nomeOriginal,
                    'status'  => 'sucesso'
                ];
            } else {
                $resultados[] = [
                    'arquivo' => $nomeOriginal,
                    'status'  => 'erro ao salvar'
                ];
            }
        }

        return $resultados;
    }
}

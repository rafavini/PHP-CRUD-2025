<?php
include_once __DIR__ . "/../vendor/autoload.php";
include_once __DIR__ . "/../Core/helper.php";
include_once __DIR__ . "/../components/alerts.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Página com Dados</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <?php showToast() ?>
    <form id="formArquivo" enctype="multipart/form-data">
        <?php
        echo genereteCsrf();
        ?>
        <input type="file" id="fileInput" name="arquivo[]" multiple>
        <button type="submit">Enviar</button>
    </form>


    <?php foreach ($result as $file): ?>
        <li>
            <?= htmlspecialchars($file['nome_original']) ?>
            (<?= round($file['tamanho'] / 1024, 2) ?> KB)
            | <a href="<?= htmlspecialchars($file['caminho']) ?>" download>Baixar</a>
            | <a href="delete.php?id=<?= $file['id'] ?>">Excluir</a>
        </li>
    <?php endforeach; ?>


    <script type="module" src="<?php echo $_ENV["FRONTEND_URL"] ?>/public/js/file.js"></script>
</body>

</html>
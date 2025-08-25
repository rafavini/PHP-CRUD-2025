<?php
include 'src/utils/utils.php';
include_once __DIR__ . "/src/utils/alerts.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php showToast()?>
    <form id="formLogin">
        <?php
        echo genereteCsrf();
        ?>
        
        <input type="text" placeholder="email" name="email">
        <input type="password" placeholder="password" name="password">
        <button type="submit">Entrar</button>
    </form>

    <script type="module" src="./src/public/js/login.js"></script>
</body>
</html>
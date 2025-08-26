<?php
require_once __DIR__ . '/../../utils/utils.php';
require_once __DIR__ . "/../../utils/enum.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form id="formCadastro">
        <?php
        echo genereteCsrf();
        ?>

        <input type="text" placeholder="username" name="username">
        <input type="text" placeholder="email" name="email">
        <input type="password" placeholder="password" name="password">

        <select name="role">
            <option value="<?php echo Role::ADMIN?>">Admin</option>
            <option value="<?php echo Role::PROFESSOR?>">Professor</option>
            <option value="<?php echo Role::ALUNO?>">Aluno</option>
        </select>

        <button type="submit">Cadastrar</button>
    </form>

    <script src="../../public/js/user.js"></script>
</body>

</html>
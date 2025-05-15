<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <form action="<?php BASE_URL ?>api/login" method="POST">
        <input type="text" name="username">
        <input type="password" name="password">
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Página com Dados</title>
</head>
<body>

    <h1>Olá, <?= htmlspecialchars($nomeUsuario); ?>!</h1>

    <p>Seu produto favorito é o **<?= htmlspecialchars($produtos['item']); ?>**.</p>
    <p>O preço é de **<?= htmlspecialchars($produtos['preço']); ?>**.</p>

</body>
</html>
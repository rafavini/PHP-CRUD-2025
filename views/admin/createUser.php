<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input,
        select,
        button {
            margin-bottom: 15px;
            padding: 10px 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        button {
            background: #3498db;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background: #2980b9;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h1>Cadastro de Usuário</h1>
        <?php showToast() ?>
        <form id="formCreateUser">
            <?= genereteCsrf() ?>

            <input type="text" name="username" placeholder="Nome de usuário" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Senha" required>

            <select name="role" required>
                <option value="" disabled selected>Selecione a função</option>
                <option value="1">Administrador</option>
                <option value="2">Aluno</option>
                <option value="3">Professor</option>
            </select>

            <button type="submit">Cadastrar</button>
        </form>
    </div>
    <script src="<?php echo $_ENV["FRONTEND_URL"] ?>/public/js/admin.js"></script>
</body>

</html>
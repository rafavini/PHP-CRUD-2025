<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Usuários</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background: #3498db;
            color: #fff;
        }

        tr:nth-child(even) {
            background: #f2f2f2;
        }

        .status {
            font-weight: bold;
            color: green;
        }

        .status.inactive {
            color: red;
        }

        .btn {
            padding: 6px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
        }

        .btn-edit { background: #3498db; color: #fff; }
        .btn-edit:hover { background: #2980b9; }

        .btn-inactivate { background: #e74c3c; color: #fff; }
        .btn-inactivate:hover { background: #c0392b; }

        /* Paginação */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            gap: 8px;
        }

        .pagination a {
            text-decoration: none;
            padding: 8px 12px;
            background: #ddd;
            color: #333;
            border-radius: 6px;
        }

        .pagination a.active {
            background: #3498db;
            color: #fff;
            font-weight: bold;
        }

        .pagination a:hover {
            background: #bbb;
        }
    </style>
</head>
<body>

<h1>Dashboard de Usuários</h1>

<?php showToast() ?>
<a href="<?php echo $_ENV["FRONTEND_URL"]?>/adminCreateUser">Cadastrar</a>

<?php if (!empty($users['users'])): ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuário</th>
                <th>Email</th>
                <th>Função</th>
                <th>Status</th>
                <th>Criado em</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users['users'] as $user): ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= MapRole($user["role"]) ?></td>
                    <td class="status <?= $user['is_active'] ? '' : 'inactive' ?>">
                        <?= $user['is_active'] ? 'Ativo' : 'Inativo' ?>
                    </td>
                    <td><?= htmlspecialchars($user['date_joined']) ?></td>
                    <td>
                        <form method="GET" action="edit_user.php" style="display:inline">
                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                            <button class="btn btn-edit">Editar</button>
                        </form>
                        <form method="POST" action="inactivate_user.php" style="display:inline">
                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                            <button class="btn btn-inactivate">
                                <?= $user['is_active'] ? 'Inativar' : 'Ativar' ?>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Paginação -->
    <?php
        $totalUsers = $users['totalUsers'];
        $totalPages = ceil($totalUsers / $limit);
    ?>
    <div class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i ?>&limit=<?= $limit ?>" class="<?= $i == $page ? 'active' : '' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>
    </div>

<?php else: ?>
    <p style="text-align:center;">Nenhum usuário encontrado.</p>
<?php endif; ?>

</body>
</html>

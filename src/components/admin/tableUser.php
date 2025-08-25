<!-- UserTable.php -->
<div class="user-table-container">
    <h1><?= $title ?? 'Lista de Usuários' ?></h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id="userTableBody">
            <!-- Linhas preenchidas via JS -->
        </tbody>
    </table>

    <div class="pagination" id="pagination">
        <!-- Paginação preenchida via JS -->
    </div>
</div>

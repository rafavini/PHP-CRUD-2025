// import { STATUS } from "../../utils/enum.js";

const perPage = 3;

async function LoadUsers(page = 1) {

    const response = await fetch(`http://localhost/php-crud-2025/src/api/controllers/userController.php?page=${page}&perPage=${perPage}`)
    const result = await response.json();
    console.log(result)

    const tbody = document.getElementById('userTableBody');
    tbody.innerHTML = '';

    result.data.forEach(user => {
        tbody.innerHTML += `
            <tr>
                <td>${user.id}</td>
                <td>${user.username}</td>
                <td>${user.email}</td>
                <td>${user.is_active ? 'Active' : 'Inactive'}</td>
                <td>
                    <a href="edit_user.php?id=${user.id}" class="button edit">Editar</a>
                    <a href="inactivate_user.php?id=${user.id}" class="button inactivate">Inativar</a>
                </td>
            </tr>
        `;
    });

    const totalPages = Math.ceil(result.totalUsers / perPage);
    const pagination = document.getElementById('pagination');
    pagination.innerHTML = '';
    for (let i = 1; i <= totalPages; i++) {
        pagination.innerHTML += `
            <a href="#" class="${i === page ? 'active' : ''}" onclick="loadUsers(${i}); return false;">${i}</a>
        `;
    }



}

LoadUsers()
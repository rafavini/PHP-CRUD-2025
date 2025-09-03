

const formCadastro = document.getElementById('formCadastro');
formCadastro.addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(formCadastro);
    const response = await fetch('http://localhost/php-crud-2025/src/api/controllers/userController.php', {
        method: 'POST',
        body: formData
    });

    const result = await response.json();
    console.log(result.data);

    if(result.success && result.data){
        const userRole = result.data.role;
        if(userRole == USER_ROLES.ADMIN){
            window.location.href = 'http://localhost/php-crud-2025/src/views/admin/dashboard.php';
        }else if(userRole == USER_ROLES.PROFESSOR){
            window.location.href = 'http://localhost/php-crud-2025/src/views/professor/dashboard.php';
        }
    }else{
        window.location.href = 'http://localhost/php-crud-2025/';
    }
}); 
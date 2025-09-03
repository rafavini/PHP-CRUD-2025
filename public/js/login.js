import { USER_ROLES } from "../../Core/enum.js";

const formLogin = document.getElementById('formLogin');
formLogin.addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(formLogin);
    const response = await fetch('/php-crud-2025/api/auth', {
        method: 'POST',
        body: formData
    });

    const result = await response.json();
    console.log(result.data);

    if (result.success && result.data) {
        const userRole = result.data.role;
        if (userRole == USER_ROLES.ADMIN) {
            window.location.href = 'http://localhost/php-crud-2025/home';
        } 
        // else if (userRole == USER_ROLES.PROFESSOR) {
        //     window.location.href = 'http://localhost/php-crud-2025/src/views/professor/dashboard.php';
        // }
    }
    else {
        window.location.href = 'http://localhost/php-crud-2025/';
    }
}); 
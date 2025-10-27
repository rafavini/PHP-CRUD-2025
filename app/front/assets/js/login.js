import { HandleApiCall } from "../../helper/handleApiCall.js";

const formLogin = document.getElementById('formLogin');
formLogin.addEventListener('submit', async (e) => {
    e.preventDefault();

    const formData = new FormData(formLogin);
    const resp = await HandleApiCall(
        {
            url: "http://localhost/php-crud-2025/app/api/controllers/LoginController.php",
            method: "POST",
            body: formData
        }
    )
    // console.log(resp)
}); 
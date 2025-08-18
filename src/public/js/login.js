const formLogin = document.getElementById('formLogin');
formLogin.addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(formLogin);
    for (let [name, value] of formData.entries()) {
        console.log(name, value);
    }

});
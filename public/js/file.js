const formFile = document.getElementById('formArquivo');
formFile.addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(formFile);

    const files = document.getElementById("fileInput").files;
    if (files.length === 0) {
        alert("Selecione pelo menos um arquivo!");
        return;
    }
    formData.forEach((value, key) => {
        console.log(key, value);
    });

    const response = await fetch("/php-crud-2025/api/file", {
        method: "POST",
        body: formData
    })

    const result = await response.json();
    console.log(result)

}); 
// document.getElementById("formArquivo").addEventListener("submit", async function (e) {
//     e.preventDefault();

//     const files = document.getElementById("fileInput").files;
//     if (files.length === 0) {
//         alert("Selecione pelo menos um arquivo!");
//         return;
//     }

//     let formData = new FormData();

//     for (let i = 0; i < files.length; i++) {
//         formData.append("arquivo[]", files[i]);
//     }


//     // formData.forEach((value, key) => {
//     //     console.log(key, value);
//     // });

//     const response = await fetch("/php-crud-2025/api/addFile", {
//         method: "POST",
//         body: formData
//     })

//     const result = await response.json();
//     console.log(result)


// fetch("/api/addFile", {   // ajuste para a sua rota/controller
//     method: "POST",
//     body: formData
// })
//     .then(res => res.json())
//     .then(data => {
//         console.log(data);
//         let statusDiv = document.getElementById("status");
//         statusDiv.innerHTML = "";

//         if (data.arquivos) {
//             data.arquivos.forEach(arq => {
//                 let p = document.createElement("p");
//                 p.textContent = `${arq.arquivo} - ${arq.status}`;
//                 statusDiv.appendChild(p);
//             });
//         } else if (data.error) {
//             statusDiv.innerHTML = `<p style="color:red">${data.error}</p>`;
//         }
//     })
//     .catch(err => {
//         console.error("Erro:", err);
//         document.getElementById("status").innerHTML = "Erro na requisição!";
//     });
// });

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

    const response = await fetch("/php-crud-2025/api/addFile", {
        method: "POST",
        body: formData
    })

    const result = await response.json();
    console.log(result)

}); 
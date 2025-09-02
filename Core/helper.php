<?php

function view($path, $data = [])
{
    // Extrai o array de dados para variáveis.
    // Ex: ['nome' => 'Maria'] se torna a variável $nome = 'Maria';
    extract($data);

    // Constrói o caminho completo para o arquivo da view.
    // Ex: 'index' vira 'views/index.view.php'
    $viewFile = 'views/' . str_replace('.', '/', $path) . '.view.php';
    
    // Inclui o arquivo da view.
    if (file_exists($viewFile)) {
        require $viewFile;
    } else {
        // Em um projeto real, você lidaria com o erro 404 de forma mais robusta.
        echo "Erro: A view '$viewFile' não foi encontrada.";
    }
}
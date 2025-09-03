<?php


class HomeController
{
    public function index()
    {
        $nomeUsuario = "João da Silva";
        $produtos = [
            'item' => 'Smartphone',
            'preço' => 'R$ 1.500',
        ];
        require __DIR__ . '/../views/home.php';
    }
}
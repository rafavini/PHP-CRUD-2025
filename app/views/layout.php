<?php
require_once './app/views/components/ToastComponent.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
</head>

<style>
.toast {
    position: fixed;
    top: 20px;
    right: 20px;
    background: #333;
    color: #fff;
    padding: 15px 20px;
    border-radius: 5px;
    opacity: 0.9;
    z-index: 1000;
    font-family: sans-serif;
    transition: opacity 0.5s ease;
}
.toast.success { background-color: #4caf50; }
.toast.error { background-color: #f44336; }
</style>


<body>

    <?php ToastComponent::render() ?>
    <?php require_once __DIR__ . "/" . $viewPath . '.php'; ?>
</body>

</html>
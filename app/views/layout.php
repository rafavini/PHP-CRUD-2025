<?php
require_once './app/views/components/ToastComponent.php';
require_once './app/views/components/MenuComponent.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="./app/views/assets/css/global.css">
</head>

<body>
    <?php MenuComponent::render()?>
    <?php ToastComponent::render() ?>
    <?php require_once __DIR__ . "/" . $viewPath . '.php'; ?>
</body>

</html>
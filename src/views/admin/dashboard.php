<?php
    include_once __DIR__ . "/../../utils/utils.php";
    include_once __DIR__ . "/../../utils/alerts.php";
    RequireAuth("admin")
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../../public/css/global.css">
    <link rel="stylesheet" href="../../public/css/navbar.css">
    <link rel="stylesheet" href="../../public/css/tableUser.css">
    
</head>

<body>
    <?php showToast() ?>
    <?php require_once __DIR__ .'/../../components/navbar.php'; ?>
    <?php require_once __DIR__ . "/../../components/admin/tableUser.php"; ?>



    <script type="module" src="../../public/js/tableUser.js"></script>
    
</body>

</html>
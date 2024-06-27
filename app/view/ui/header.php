<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Aplikasi Pos Kasir</title>
        <link rel="shortcut icon" href="../../../assets/<?php echo $_SESSION['gambar']?>" type="image/x-icon">
        <?php 
            session_start();
            if($_SESSION['role'] == "admin"){
                require_once("../../config/auth.php");
            }elseif($_SESSION['role'] == "cashier"){
                require_once("../../config/auth2.php");
            }
            require_once("../../config/config.php");
            require_once("../route/web.php");
        ?>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.dataTables.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
        <!--  -->
        <link href="../../../dist/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="../../../dist/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="../../../dist/vendor/quill/quill.snow.css" rel="stylesheet">
        <link href="../../../dist/vendor/quill/quill.bubble.css" rel="stylesheet">
        <link href="../../../dist/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="../../../dist/vendor/simple-datatables/style.css" rel="stylesheet">
        <link href="../../../dist/css/styles.css" rel="stylesheet">
        <link href="./styles.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.css" rel="stylesheet" />
    </head>

    <body>
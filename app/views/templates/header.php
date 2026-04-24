<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $data['title'] ?></title>
    <link rel="icon" href="<?= BASEURL; ?>/asset/img/logo1.png">
    <link href="<?= BASEURL; ?>/asset/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="<?= BASEURL; ?>/asset/js/all.min.js"></script>
    <script src="https://kit.fontawesome.com/4ffb6f23df.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-primary">
        <a class="navbar-brand" href="<?= BASEURL . '/' . $_SESSION['session']['role'] ?>"><img src="<?= BASEURL ?>/asset/img/logo2.png" width="90%" alt="logo"></a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $_SESSION['session']['username'] ?> <i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="<?= BASEURL; ?>/auth/logout">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="mt-4">
                            <a class="nav-link" href="<?= BASEURL . '/' . $_SESSION['session']['role'] ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-fw fa-home"></i></div>
                                Dashboard
                            </a>
                        </div>
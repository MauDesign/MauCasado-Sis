<!DOCTYPE HTML>
<?php 
require_once "connect.php";
//recuperar id de usuario que incio sesion
/*$user = array();
if(isset($_SESSION["logged"])){
    $user_id = $_SESSION["logged"]["user_id"];
    $sql = "SELECT * FROM users WHERE user_id = $user_id";
    $user_query = mysqli_query($db, $sql);
    $user = mysqli_fetch_assoc($user_query);
}*/
?>
<html
lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="assets/"
  data-template="vertical-menu-template">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Mauricio Casado | Diseño y desarrollo web</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poiret+One&display=swap" rel="stylesheet">

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/core.css" />
    <link rel="stylesheet" href="assets/vendor/css/theme-semi-dark.css" />
    <link rel="stylesheet" href="assets/vendor/libs/dropzone/dropzone.css" />
    <link rel="stylesheet" href="assets/vendor/libs/select2/select2.css" />
    <link rel="stylesheet" href="assets/vendor/libs/flatpickr/flatpickr.css" />
    <link rel="stylesheet" href="assets/vendor/libs/select2/select2.css " />
    <link rel="stylesheet" href="assets/css/estilos.css"/>
</head>
<script src="assets/vendor/js/dropdown-hover.js"></script>
<script src="assets/vendor/js/mega-dropdown.js"></script>
<script src="assets/vendor/js/menu.js"></script>
<body>

<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="menu menu-vertical bg-dark py-3 overflow-hidden" id="menu-1" style="height: 450px">
    
        <a class="navbar-brand" href="javascript:void(0)"><img src="assets/img/logo_blanco_MC.png" class="app-brand" alt="logo MC"
                  data-aos="fade-down"
                  data-aos-delay="0"
                  style="width: 13rem;"
        /></a>  
    <ul id="slide-out" class="menu-inner">
        <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
              <i class="menu-icon mdi mdi-home-outline"></i>
              <div>Padel</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link">
                  <div>Jugadores</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link">
                  <div>Clubs</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="javascript:void(0)" class="menu-link">
                  <div>Retas</div>
                </a>
              </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
              <i class="menu-icon mdi mdi-home-outline"></i>
              <div>Clientes</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item">
                <a href="clientes.php" class="menu-link">
                  <div>Clientes</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="alta-cliente.php" class="menu-link">
                  <div>Registrar cliente</div>
                </a>
              </li>
            </ul>
          </li>
          <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
              <i class="menu-icon mdi mdi-home-outline"></i>
              <div>Proyectos</div>
            </a>
            <ul class="menu-sub">
              <li class="menu-item">
                <a href="proyectos.php" class="menu-link">
                  <div>Proyectos</div>
                </a>
              </li>
              <li class="menu-item">
                <a href="alta-proyectos.php" class="menu-link">
                  <div>Alta proyectos</div>
                </a>
              </li>
            </ul>
          </li>
      </ul>
    </div>
    </aside> 
    <!-- nav bar-->
    <div class="layout-page">
    <nav class="layout-navbar container shadow-none py-0">
    <div class="navbar navbar-expand-lg landing-navbar border-top-0 px-3 px-md-4">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-ex-7">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-ex-7">
      <div class="navbar-nav me-auto">
            <a class="nav-item nav-link active" href="javascript:void(0)">Home</a></li>
            <a class="nav-item nav-link" href="javascript:void(0)">About</a></li>
            <a class="nav-item nav-link" href="javascript:void(0)">Contact</a></li>
            <a class="nav-item nav-link disabled" href="javascript:void(0)">Disabled</a></li>
          </div>
        <ul class="navbar-nav ms-lg-auto">
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0)"><i class="tf-icons navbar-icon mdi mdi-account-outline me-1"></i>Profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0)"><i class="tf-icons navbar-icon mdi mdi-cog-outline me-1"></i>Settings</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="javascript:void(0)"><i class="tf-icons navbar-icon mdi mdi-lock-outline me-1"></i>Logout</a>
            </li>
        </ul>
      </div>
      </div>
    </nav>
    <!-- Navbar: End -->
<!-- Content -->
<div class="content-wrapper">

        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">


 
  
  <script type="text/javascript">
  const menu1 = document.querySelector('#menu-1');
        if (menu1) {
          new Menu(menu1);
        }
       
  </script>
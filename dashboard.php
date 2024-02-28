<?php 
require_once 'includes/redirect.php';
require_once "includes/side.php";
?>
<body>
<div class="container">
    <div class="row">
        <div class="col s12">
            <h2>Dashboard</h2>
            <p>Bienvenido <?=$_SESSION["logged"]["nombre"]?> <?=$_SESSION["logged"]["apellido"]?></p>
        </div>
    </div>
</div>

<?php
require_once 'includes/footer.php'
?>

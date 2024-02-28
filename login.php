<?php 
include 'includes/login-user.php';
include 'includes/header.php';
?>
<?php
if(isset($_SESSION["logged"])){
    header("Location: dashboard.php");
}
?>

<div class="row cont-log">
    <div class="container">
    <?php if(isset($_SESSION["error_login"])){ ?>
                <div class="alert alert-danger" role="alert">
                    <?=$_SESSION["error_login"] ?>
                </div>
    <?php } ?> 
        <div class="login-cont">
        <a href="#" class="brand-logo" style="margin-top:1rem;"><img src="assets/img/Logo-login_MC.png" alt="logo_MauricioCasado.com" width="100%"></a>
            <h3>Iniciar sesión</h3>
            <form action="includes/login-user.php" method="POST">
                <div class="form-floating">
                    <input type="text" name="email" id="email" placeholder="John Doe" type="email" class="form-control">
                    <label for="email">Email</label>
                    <span class="form-floating-focused"></span>
                </div>
                <div class="form-floating">
                    <input type="password" name="pass" id="pass" placeholder="Password" class="form-control">
                    <label for="pass">Contraseña</label>
                    <span class="form-floating-focused"></span>
                </div>
                <div class="form-floating" style="margin-top:1.5rem;">
                    <input type="submit" name="submit" value="Ingresar" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

<?php 
include 'includes/footer.php';
?>
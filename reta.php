<?php 
include 'includes/redirect.php';
require_once 'includes/side.php';
?>

<?php 


$error = array();
function validation_errors($error, $field){
    if(isset($error[$field]) && !empty($field)) { 
        $alert = '<div class="helper-text">'.$error[$field].'</div>';
        
    } else{
        $alert = '';
    }
    return $alert;
}

function setValueField($error, $field, $textarea = false){
    if(isset($error) && count($error) >= 1 && isset($_POST[$field])){ 
        if($textarea != false){
            echo $_POST[$field];
        }else{
        echo "value='{$_POST[$field]}'";
        }
    }
}

if(isset($_GET["id"])){
    $reta_id = $_GET["id"];
    $reta_query = mysqli_query($db, "SELECT * FROM retas WHERE reta_id = {$reta_id}");
    $reta = mysqli_fetch_assoc($reta_query);
}


  
if(isset($_POST['submit'])){

    if(isset($_POST['jugador'])&& !empty($_POST['jugador'])){
        $jugador_validate = true;
    }else{
        $jugador_validate = false;
        $error['jugador'] = "El nombre del jugador no es valido";
    }

    if(count($error) == 0){
        $sql = "INSERT INTO jugadores VALUES(NULL, '{$_POST["jugador"]}', '$reta_id', NULL);";
        $insert_jugador = mysqli_query($db, $sql);

    } else{
        $insert_jugador = false;
    }
}
?>
 <!-- crear un formulario para los campos "nombre" "apellido" "biografia"
    "email" "imagen" "contraseña" "rol" -->

<div class="container">
<h3>reta</h3>
<?php

?>
<div class="row">
    <div class="container">
        <div class="col s12 m4 l4">
            <h5>Datos de la reta</h5>
            <p>Club: <?php if($reta['club']) {
                $clubs = mysqli_query($db, "SELECT * FROM clubs WHERE club_id = {$reta['club']}");
                $club_name = mysqli_fetch_assoc($clubs);
                echo $club_name["club_name"];} ?></p>
            <p>Fecha: <?= $reta['fecha'] ?></p>
            <p>Hora: <?= $reta['hora'] ?></p>
            <p>Canchas: <?= $reta['canchas'] ?></p>
        </div>
        <div class="col s12 m8 l8">
            <h5>Agregar jugadores</h5>
            <form action="" method="POST">
                <div class="row">
                    <div class="input-field col s12">
                    <input type="text" id="jugador" name="jugador" class=" col s8 m8 l8">
                    <label for="jugador">Agregar Jugador</label>
                    <input type="submit" value="Agregar" name="submit" class="btn">
                    </div>
                </div>
            </form>
            <div>
        <div class="row">
            <div class="col s12">
            <table class="striped responsive-table">
            <thead class="teal accent-3">
                <tr>
                    <th>Nombre </th>
                    <th>Puntos</th>
                </tr>
            </thead> 
            <tbody class="">      
            <?php 
            $jugadores = mysqli_query($db, "SELECT * FROM jugadores WHERE reta_id = {$reta_id}");
            while ($jugador = mysqli_fetch_assoc($jugadores)) { ?>
                <tr> 
                    <td><?= $jugador['nombre_jugador'] ?></td>
                    <td><?= $jugador['puntos'] ?></td>
                </tr> 
                <?php 
            }?>
                
            </div>
        </div>


            </div>
        </div>
    </div>
        
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  
</div>
<!-- formualario con los campos club fecha hora y canchas donde en el campo de club se muestren las opciones que estan en la base de datos en la tabla canchas valida esots campos en php y agregalos a la tabala retas -->
<script type="text/javascript">
    
  // Or with jQuery

  $(document).ready(function(){
    $('.datepicker').datepicker();
  });
  $(document).ready(function(){
    $('.timepicker').timepicker();
  });
</script>
<script type="text/javascript">
  $(document).ready(function() {
    M.updateTextFields();
    $('select').formSelect();
});
 
</script>
<?php 
require_once 'includes/footer.php';
?>
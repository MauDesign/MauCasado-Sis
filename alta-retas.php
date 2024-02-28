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
if(isset($_POST["submit"])){

    if(isset($_POST["club"])){
        $club_validate = true;
      }else{
          $club_validate = false;
          $error["club"] = "Selecciona un club";
      }
     //validar campo de fecha para poder insertarlo en base de datos y que sea mayor a la fecha actual.
     if(!empty($_POST['fecha'])){
        $date = date('Y-m-d', strtotime($_POST['fecha']));
        if ($date > date("Y-m-d")) {
            $date_validate = true;
            }else{
                $date_validate = false;
                $error["fecha"] = "La fecha no puede ser menor o igual a la actual.";
                }
                }
                //validar campo de hora para poder insertarlo en base de datos
    if(!empty($_POST['hora'])){
            $time = date('H:i',strtotime($_POST['hora']));
            if (preg_match("/^([01][0-9]|2[0-3]):?([0-5][0-9])?(:[0-5][0-9])?$/", $time)) {
                $hour_validate = true;
            }else{
                $hour_validate = false;
                $error["hora"] = "Ingresa una hora valida";
                }
    }
// validar el camco canchas no este vacio y sea numerico para poder insertarlo en base de datos

    if(isset($_POST["canchas"]) && is_numeric($_POST["canchas"])){
        $canchas_validate = true;
    }else{
        $canchas_validate = false;
        $error["canchas"] = "Selecciona cuantas canchas jugaran";
    }
    
    //si todos los campos estan validos se crea la reta
    if(count($error)==0) {
        // insertar formulario a base de datos depues de la validacion
        // insertar datos a base de datos, toma la informacion del select
     
        $sql = "INSERT INTO retas VALUES(NULL, '{$_POST["club"]}', '".$date."','".$time."',  '{$_POST["canchas"]}');";
        $insert_reta = mysqli_query($db, $sql);
        var_dump($sql); 
        var_dump($error);
    var_dump($insert_reta);  
    } else{
        $insert_reta = false;
    }


}   

?>
 <!-- crear un formulario para los campos "nombre" "apellido" "biografia"
    "email" "imagen" "contraseña" "rol" -->

<div class="container">
<h3>Da de alta tu reta</h3>
<div class="row">
    <?php 
    if(isset($_POST["submit"]) && count($error) == 0 && $insert_reta != false){?>
    <div class="materialert success">
		    <div class="material-icons">check</div>
		    Formulario guardado correctamente 
	</div>
    <?php } ?>
 <!-- formulariomostrar opciones del select los datos de la tabla canchas de la base de datos -->
</div>
<div class="row">
    <form action="alta-retas.php" method="POST" enctype="multipart/form-data" class="col-12">     
    <div class="input-field col s6">
            <select name="club" id="club" name="club" >
                <option value="" <?php setValueField($error, "club")?> disabled selected>Select a option</option>
                <?php 
                //consulta para recuperar la informacion dela tabla canchas y mostrarla en las opciones select del formulario
                $sql2 = "SELECT * FROM clubs";
                $result= mysqli_query($db, $sql2);
                while($club = mysqli_fetch_assoc($result)){ ?>
                    <option value="<?=$club['club_id']?>"> <?=$club['club_name']?></option>
                <?php
            var_dump($club); } ?>
            </select>
            <label for="cancha">Cancha</label>
            <?php echo validation_errors($error, "club"); ?>
        </div>
        
    <!--<div class="input-field col s6"> 
            <select name="club" id="club" name="club" >
                <option value="" <?php // setValueField($error, "club")?> disabled selected>Selecciona un club</option>
                <option value="1">Por Tress</option>
                <option value="2">State Padel</option>
                <option value="3">Pro Master</option>
            </select>
            <label for="club">Club</label>
            <?php // echo validation_errors($error, "club"); ?>
        </div> -->


        <div class="input-field col s6">
            <label for="fecha">Fecha de la reta</label>
            <input type="text" class="datepicker" name="fecha" <?php setValueField($error, "fecha")?>>
            <?php echo validation_errors($error,"fecha"); ?>
        </div>
        <div class="input-field col s6">
            <label for="hora">Hora de la reta</label>
            <input type="text" class="timepicker" name="hora" <?php setValueField($error, "hora")?>>
            <?php echo validation_errors($error,"hora"); ?>
        </div>
        <div class="input-field col s6"> <!-- mostrar opciones del select los datos de la tabla canchas de la base de datos -->
            <select name="canchas" id="canchas" name="canchas" <?php setValueField($error, "canchas")?>>
                <option value="" disabled selected>Selecciona cuantas canchas</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
            <label for="canchas">Canchas</label>
            <?php echo validation_errors($error, "canchas"); ?>
        </div>
        <div class="input-field col s6">    
            <input class="waves-effect waves-light btn" type="submit" name="submit" value="Crear Reta" >
        </div>    
    </form>
        
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
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
    
    if(!empty($_POST["club_name"]) && strlen($_POST["club_name"]) <= 20 ){
       $nombre_validate = true;
    }else{
        $nombre_validate = false;
        $error["club_name"] = "El nombre no es valido";
    }
    if(!empty($_POST["phone"]) && is_numeric($_POST["phone"]) && strlen($_POST["phone"]) == 10 ){
        $phone_validate = true;
    }else{
        $phone_validate = false;
        $error["phone"] = "El teléfono  no es valido de conetenes 10 Dígitos.";
    }

    
      $imagen = null;
      if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] != UPLOAD_ERR_NO_FILE) {
        
        if(!is_dir("clubs")){
            $dir = mkdir("clubs", 0777,true);
        }else{
            $dir = true;
        }

        if($dir){
            $filename = time()."-".$_FILES["imagen"]["name"];
            $muf = move_uploaded_file($_FILES["imagen"]["tmp_name"], "clubs/".$filename);
            
            $imagen = $filename;

            if($muf){
                $imagen_upload = true;
            }else{
                $imagen_upload = false;
                $error["imagen"] = "La imagen no se ha cargado.";
            }
           
        }
        if(isset($_POST["canchas"]) && is_numeric($_POST["canchas"])){
            $canchas_validate = true;
        }else{
            $canchas_validate = false;
            $error["canchas"] = "Selecciona cuantas canchas jugaran";
        }
       
    }


    
    //si todos los campos estan validos se crea el usua
    if(count($error)==0) {
        $sql = "INSERT INTO clubs VALUES(NULL, '{$_POST["club_name"]}', '{$_POST["imagen"]}', '{$_POST["phone"]}',  '{$_POST["facebook"]}', '{$_POST["instagram"]}', '{$_POST["canchas"]}' );";
        $insert_club = mysqli_query($db, $sql);
       
    } else{
        $insert_club = false;
    } var_dump($error);
    echo $sql;
    die();


}   

?>
 <!-- crear un formulario para los campos "nombre" "apellido" "biografia"
    "email" "imagen" "contraseña" "rol" -->

<h3>Crear Usuario</h3>
<div class="row">
    <?php 
    if(isset($_POST["submit"]) && count($error) == 0 && $insert_club != false){?>
    <div class="materialert success">
		    <div class="material-icons">check</div>
		    Club guardado correctamente 
	</div>
    <?php } ?>
 
    <form action="alta-club.php" method="POST" enctype="multipart/form-data" class="col-12">
    
        <div class="input-field col s6">
            <input type="text" name="club_name" id="club_name" class="validate" <?php setValueField($error, "club_name")?>>
            <label for="club_name">Nombre del club:</label>
            <?php echo validation_errors($error,"club_name") ?>
            
        </div>

        <div class="file-field input-field col s6">
            <div class="btn">
                <span>Imagen</span>
                <input type="file" name="imagen">
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" name="imagen" type="text" placeholder="Sube el Logo">
            </div>
        </div>
        
        <div class="input-field col s6">
            <input type="text" name="phone" id="phone" class="phone" <?php setValueField($error, "phone")?>>
            <label for="phone">Teléfono:</label>
            <?php echo validation_errors($error,"phone"); ?>
        </div> 
        <div class="input-field col s6">
            <input type="text" name="facebook" id="facebook" class="facebook" <?php setValueField($error, "facebook")?>>
            <label for="facebook">Facebook:</label>
            <?php echo validation_errors($error,"facebook"); ?>
        </div> 
        <div class="input-field col s6">
            <input type="text" name="instagram" id="instagram" class="instagram" <?php setValueField($error, "instagram")?>>
            <label for="facebook">Instagram:</label>
            <?php echo validation_errors($error,"instagram"); ?>
        </div>
        <div class="input-field col s6"> <!-- mostrar opciones del select los datos de la tabla canchas de la base de datos -->
            <select name="canchas" id="canchas" name="canchas" <?php setValueField($error, "canchas")?>>
                <option value="" disabled selected>Selecciona cuantas canchas</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
            </select>
            <label for="canchas">Canchas</label>
            <?php echo validation_errors($error, "canchas"); ?>
        </div>  
        <div class="input-field col s6">    
            <input class="waves-effect waves-light btn" type="submit" name="submit" value="Guardar usuario" >
        </div>
          
    </form>
        
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  
</div>

<?php 
require_once 'includes/footer.php';
?>
<script type="text/javascript">
  $(document).ready(function() {
    M.updateTextFields();
    $('select').formSelect();
});
 
</script>

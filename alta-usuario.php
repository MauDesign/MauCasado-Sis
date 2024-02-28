<?php 
//include 'includes/redirect.php';
require_once 'includes/header.php';
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
    
    if(!empty($_POST["nombre"]) && strlen($_POST["nombre"]) <= 20 
    && !is_numeric($_POST["nombre"]) && !preg_match("/[0-9]/", $_POST["nombre"])){
       $nombre_validate = true;
    }else{
        $nombre_validate = false;
        $error["nombre"] = "El nombre no es valido";
    }
    if(!empty($_POST["apellido"]) && !is_numeric($_POST["apellido"]) && !preg_match("/[0-9]/", $_POST["apellido"])){
        $apellido_validate = true;
    }else{
        $apellido_validate = false;
        $error["apellido"] = "El apellido no es valido";
    }
    if(!empty($_POST["biografia"])){
       $bio_validate = true;
    }else{
        $bio_validate = false;
        $error["biografia"] = "La descripción no es correcta";
    }
    if(!empty($_POST["pass"]) && strlen($_POST["pass"]) >= 7 ){
        $pass_validate = true;
    }else{
        $pass_validate = false;
        $error["pass"] = "La contraseña debe tener mas de 6 caracteres";
    }
    if(!empty($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
        $email_validate = true;
    }else{
        $email_validate = false;
        $error["email"] = "No es un email valido";
    }
    if(isset($_POST["rol"]) && is_numeric($_POST["rol"])){
        $rol_validate = true;
      }else{
          $rol_validate = false;
          $error["rol"] = "Selecciona un rol";
      }
      
      $imagen = null;
    if(isset($_FILES["imagen"]) && !empty($_FILES["imagen"]["tmp_name"])){
        
        if(!is_dir("uploads")){
            $dir = mkdir("uploads", 0777,true);
        }else{
            $dir = true;
        }

        if($dir){
            $filename = time()."-".$_FILES["imagen"]["name"];
            $muf = move_uploaded_file($_FILES["imagen"]["tmp_name"], "uploads/".$filename);
            
            $imagen = $filename;

            if($muf){
                $imagen_upload = true;
            }else{
                $imagen_upload = false;
                $error["imagen"] = "La imagen no se ha cargado.";
            }
        }

    }
    
    //si todos los campos estan validos se crea el usuario
    if(count($error)==0) {
        $sql = "INSERT INTO users VALUES(NULL, '{$_POST["nombre"]}', '{$_POST["apellido"]}', '{$_POST["biografia"]}',  '{$_POST["email"]}', '".sha1($_POST["pass"])."', '{$_POST["rol"]}', '{$imagen}' );";
        $insert_user = mysqli_query($db, $sql);
        
    } else{
        $insert_user = false;
    }

}   

?>
 <!-- crear un formulario para los campos "nombre" "apellido" "biografia"
    "email" "imagen" "contraseña" "rol" -->



<div class="row">
    <div class="col-md-6" style="margin:auto;">
    <div class="card">
            <div class="card-body">
                <div class="container">
                <h2 style="color:var(--primary-color);">Crear Usuario</h2>
            <?php 
            if(isset($_POST["submit"]) && count($error) == 0 && $insert_user != false){?>
            <div class="materialert success">
                    <div class="material-icons">check</div>
                    Formulario guardado correctamente 
                </div>
                <?php } ?>
 
                <form action="alta-usuario.php" method="POST" enctype="multipart/form-data" class="col-12">
                
                    <div class="form-floating mb-3">
                        <input type="text" name="nombre" id="nombre" class="form-control validate" <?php setValueField($error, "nombre")?> placeholder="Jhon">
                        <label for="nombre">Nombre:</label>
                        <?php echo validation_errors($error,"nombre") ?>
                        
                    </div>
                    
                    <div class="form-floating mb-3">
                        <input type="text" name="apellido" id="apellido" class="form-control validate" <?php setValueField($error, "apellido")?> placeholder="Doe">
                        <label for="apellido">Apellido:</label>
                        <?php echo validation_errors($error,"apellido"); ?>
                    </div>
                    
                    <div class="form-floating mb-3">
                    <textarea class="form-control" id="biografia" name="biografia" class="form-control validate" <?php setValueField($error, "biografia", true)?> placeholder="Escribe sobre ti"></textarea>
                    <label for="biografia">Biografía:</label>
                    <?php echo validation_errors($error, "biografia"); ?>
                    </div>  
                    
                    <div class="form-floating mb-3">
                        <input id="password" name="pass" type="password" class="form-control validate" <?php setValueField($error, "pass")?> placeholder="Password">
                        <label for = "password">Contraseña:</label>
                        <?php echo validation_errors($error, "pass"); ?>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <input type="text" name="email" id="email" class=" form-control validate" <?php setValueField($error, "email")?> placeholder="tucorreo@ejemplo.com">
                        <label for="email">E-mail:</label>
                        <?php echo validation_errors($error, "email"); ?>
                    </div>
                    
                    
                
                    <div class="file-field form-floating mb-3">
                        <div class=" form-control btn">
                            <span>Imagen</span>
                            <input type="file" name="imagen">
                        </div>
                    </div>
                
                    <div class="form-floating mb-3"> 
                        <select name="rol" id="rol" class="select2-icons form-select" name="rol" <?php setValueField($error, "rol")?>>
                            <option value="" disabled selected>Selecciona una opcion</option>
                            <option value="1">Administrador</option>
                            <option value="2">Editor</option>
                            <option value="3">Redactor</option>
                        </select>
                        <label for="rol">Rol</label>
                        <?php echo validation_errors($error, "rol"); ?>
                    </div>
                    <div class="form-floating mb-3">    
                        <input class="btn-primary btn" type="submit" name="submit" value="Guardar usuario" >
                    </div>    
                </form>
            </div> 
         </div>
    </div>
</div>

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

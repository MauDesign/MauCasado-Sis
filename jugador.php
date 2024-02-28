<?php 
include 'includes/redirect.php';
require_once 'includes/side.php';
?>

<?php 
function validation_errors($error, $field){
    if(isset($error[$field]) && !empty($field)) { 
        $alert = '<div class="helper-text">'.$error[$field].'</div>';
        
    } else{
        $alert = '';
    }
    return $alert;
}

function setValueField($data, $field, $textarea = false){
    if(isset($data) && count($data) >= 1){ 
        if($textarea != false){
            echo $data[$field];
        }else{
        echo "value='{$data[$field]}'";
        }
    }
}
//coseguir la informacion del usuario desde base de datos
//if(!isset($_GET["id"]) ){//|| empty($_GET["id"]) || !is_numeric($_GET["id"])){
  //  header("Location: jugadores.php");
//
if(isset($_GET["id"])){
    $user_id = $_GET["id"];
    $user_query = mysqli_query($db, "SELECT * FROM users WHERE user_id = {$user_id}");
    $user = mysqli_fetch_assoc($user_query);
}
//if(!isset($user["user_id"]) || empty($user["user_id"])){
   // header("Location: jugadores.php");
//}

// validar formulario
$error = array();
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
    /*if(!empty($_POST["pass"]) && strlen($_POST["pass"]) >= 7 ){
        $pass_validate = true;
    }else{
        $pass_validate = false;
        $error["pass"] = "La contraseña debe tener mas de 6 caracteres";
    }*/
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
    
    //Actualizar registro
    if(count($error)==0) {
        $sql = "UPDATE users SET nombre ='{$_POST["nombre"]}'," 
        ."apellido = '{$_POST["apellido"]}',"
        ."biografia = '{$_POST["biografia"]}',"
        ."email = '{$_POST["email"]}',";

        if(isset($_POST["pass"]) && !empty($_POST["pass"])){
            $sql.= "pass = '".sha1($_POST["pass"])."',";
        }
        
        if(isset($_FILES["imagen"]) && !empty($_FILES["imagen"]["tmp_name"])){
            $sql.="imagen = '{$imagen}', ";
        }
        $sql.= "rol = '{$_POST["rol"]}' WHERE user_id = {$user_id}";

        $update_user = mysqli_query($db, $sql);
        
        if($update_user){
            $user_query = mysqli_query($db, "SELECT * FROM users WHERE user_id = {$user_id}");
            $user = mysqli_fetch_assoc($user_query);
        }
        
    } else{
        $update_user = false;
    }

}   

?>
 <!-- crear un formulario para los campos "nombre" "apellido" "biografia"
    "email" "imagen" "contraseña" "rol" -->



<div class="row">
    <div class="container">
    <h3>Editar a <?php echo $user["nombre"]." ".$user["apellido"]; ?></h3>
    <?php 
    if(isset($_POST["submit"]) && count($error) == 0 && $update_user != false){?>
    <div class="materialert success">
		    <div class="material-icons">check</div>
		    Formulario guardado correctamente 
		</div>
        <?php } elseif(isset($_POST["submit"])){?>
            <div class="materialert error">
		    <div class="material-icons">cancel</div>
		    Formulario No se ha guardado correctamente 
		</div>
        <?php } ?>
 <div class="row">
 <div class="col s12 m4 l4">
        <img src="uploads/<?= $user['imagen'] ?>" class="responsive-img" >
 </div>
    <div class="col s12 m8 l8">
    <form action="" method="POST" enctype="multipart/form-data" class="col-12">
    
        <div class="input-field col s6">
            <input type="text" name="nombre" id="nombre" class="validate" <?php setValueField($user, "nombre")?>>
            <label for="nombre">Nombre:</label>
            <?php echo validation_errors($error,"nombre") ?>
            
        </div>
        
        <div class="input-field col s6">
            <input type="text" name="apellido" id="apellido" class="validate" <?php setValueField($user, "apellido")?>>
            <label for="apellido">Apellido:</label>
            <?php echo validation_errors($error,"apellido"); ?>
        </div>
        
        <div class="input-field col s12">
        <textarea class="materialize-textarea" id="biografia" name="biografia" class="validate" ><?php setValueField($user, "biografia", true)?></textarea>
        <label for="biografia">Biografía:</label>
        <?php echo validation_errors($error, "biografia"); ?>
        </div>  
        
        <div class="input-field col s6">
            <input id="password" name="pass" type="password" class="validate" <?php setValueField($user, "pass")?>>
            <label for = "password">Contraseña:</label>
            <?php echo validation_errors($error, "pass"); ?>
        </div>
        
        <div class="input-field col s6">
            <input type="text" name="email" id="email" class="validate" <?php setValueField($user, "email")?>>
            <label for="email">E-mail:</label>
            <?php echo validation_errors($error, "email"); ?>
        </div>
        
        
    
        <div class="file-field input-field col s6">
            <div class="btn">
                <span>Imagen</span>
                <input type="file" name="imagen">
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" name="imagen" type="text" placeholder="Sube tu foto">
            </div>
        </div>
    
        <div class="input-field col s6"> 
            <select name="rol" id="rol" name="rol">
                <option value="" <?php if($user["rol"] == 0){ echo "selcted='selected'";} ?> disabled selected>Selecciona una opcion</option>
                <option value="1"<?php if($user["rol"] == 1){ echo "selcted='selected'";} ?>>Administrador</option>
                <option value="2"<?php if($user["rol"] == 2){ echo "selcted='selected'";} ?>>Editor</option>
                <option value="3"<?php if($user["rol"] == 3){ echo "selcted='selected'";} ?>>Redactor</option>
            </select>
            <label for="rol">Rol</label>
            <?php echo validation_errors($error, "rol"); ?>
        </div>
        <div class="input-field col s6">    
            <input class="waves-effect waves-light btn" type="submit" name="submit" value="Guardar usuario" >
        </div>    
    </form>
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

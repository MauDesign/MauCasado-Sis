<?php 
//include 'includes/redirect.php';
require_once 'includes/side.php';
?>

<?php 
$error = array();
function validation_errors($error, $field){
    if(isset($error[$field]) && !empty($field)) { 
        $alert = '<div class="helper-text wrong" style="color: red;">'.$error[$field].'</div>';
        
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
    
    if(!empty($_POST["nombre"]) && strlen($_POST["nombre"]) <= 50){
       $nombre_validate = true;
    }else{
        $nombre_validate = false;
        $error["nombre"] = "El nombre no es valido";
    }
    if(!empty($_POST["descripcion"])){
        $descripcion_validate = true;
    }else{
        $descripcion_validate = false;
        $error["descripción"] = "El apellido no es valido";
    }
   /* $imagen = null;
    if(isset($_FILES["destacada"]) && !empty($_FILES["destacada"]["tmp_name"])){
        
        if(!is_dir("uploads")){
            $dir = mkdir("uploads", 0777,true);
        }else{
            $dir = true;
        }

        if($dir){
            $filename = time()."-".$_FILES["destacada"]["name"];
            $muf = move_uploaded_file($_FILES["destacada"]["tmp_name"], "uploads/".$filename);
            
            $imagen = $filename;

            if($muf){
                $imagen_upload = true;
            }else{
                $imagen_upload = false;
                $error["destacada"] = "La imagen no se ha cargado.";
            }
        }

    }*/
    $images = [];
    if (isset($_FILES["destacada"]) && is_array($_FILES["destacada"]["name"])) {
        
        if (!is_dir("uploads")) {
            mkdir("uploads", 0777, true);
        }

        for ($i = 0; $i < count($_FILES["destacada"]["name"]); $i++) {
            if (!empty($_FILES["destacada"]["tmp_name"][$i])) {
                $filename = time() . "-" . $_FILES["destacada"]["name"][$i];
                $uploadPath = "uploads/" . $filename;

                if (move_uploaded_file($_FILES["destacada"]["tmp_name"][$i], $uploadPath)) {
                    $images[] = $filename;
                } else {
                    $errors["destacada"][$i] = "File " . $_FILES["destacada"]["name"][$i] . " could not be uploaded.";
                }
            }
        }

    }
    if(!empty($_POST["link"])){
        $link_validate = true;
    }else{
        $link_validate = false;
        $error["link"] = "El link no es valido";
    }
    if(!empty($_POST['fecha_inicio'])){
        $fecha_inicio = date('Y-m-d', strtotime($_POST['fecha_inicio']));
        if ($fecha_inicio > date("Y-m-d")) {
            $fecha_inicio_validate = true;
        }else{
            $fecha_inicio_validate = false;
            $error["fecha_inicio"] = "La fecha no puede ser menor o igual a la actual.";
            }
    }

    if(!empty($_POST['fecha_fin'])){
        $fecha_fin = date('Y-m-d', strtotime($_POST['fecha_fin']));
        if ($fecha_fin > date("Y-m-d")) {
            $fecha_fin_validate = true;
        }else{
            $fecha_fin_validate = false;
            $error["fecha_fin"] = "La fecha no puede ser menor o igual a la actual.";
            }
    }

    if(isset($_POST["estado"]) && is_numeric($_POST["estado"])){
        $estado_validate = true;
      }else{
          $estado_validate = false;
          $error["estado"] = "Selecciona un estatus del proyecto";
      }

      if(isset($_POST["cliente"]) && is_numeric($_POST["cliente"])){
        $cliente_validate = true;
      }else{
          $cliente_validate = false;
          $error["cliente"] = "Selecciona un cliente";
      }

      if(isset($_POST["tipo_proyecto"]) && is_numeric($_POST["tipo_proyecto"])){
        $tipoPro_validate = true;
      }else{
          $tipoPro_validate = false;
          $error["tipo_proyecto"] = "Selecciona un tipo de proyecto";
      }
      
    //si todos los campos estan validos se crea el usuario
   /*if(count($error)==0) {
        $sql = "INSERT INTO proyectos VALUES(NULL, '{$_POST["nombre"]}', '{$_POST["descripcion"]}','{$imagen}', '{$_POST["link"]}', '".$fecha_inicio."', '".$fecha_fin."'  '{$_POST["estado"]}', NULL ,'{$_POST["cliente"]}', '{$_POST["tipo_proyecto"]}' );";
        $insert_proyecto = mysqli_query($db, $sql); 
    } else{
        $insert_proyecto = false;
    }var_dump($insert_proyecto);
}   */
if(count($error) == 0) {
     $user_id = ($_SESSION['user_id']);// Obtén el ID del usuario de la sesión actual
     
     $sql = "INSERT INTO proyectos VALUES (NULL, '{$_POST["nombre"]}', '{$_POST["descripcion"]}', '$images', '{$_POST["link"]}', '$fecha_inicio', '$fecha_fin', '{$_POST["estado"]}', NULL, '{$_POST["cliente"]}', '{$_POST["tipo_proyecto"]}')";

     $insert_proyecto = mysqli_query($db, $sql);
     
    
}else{
    $insert_proyecto = false;
    
}
var_dump($insert_proyecto);?><br>
    <?php ?><br>
    <?php var_dump($error);?><br>
    <?php var_dump($_SESSION);?><br>
    <?php var_dump($_POST);
    //mostrar fecha del servidor
    echo date("Y-m-d");
    ?><br>

    <?php die();
}

?>
 <!-- crear un formulario para los campos "nombre" "apellido" "biografia"
    "email" "imagen" "contraseña" "rol" -->
<div class="card">
    <div class="container">
    <h3 style="color:var(--primary-color">Crear Proyecto</h3>
    <?php 
    if(isset($_POST["submit"]) && count($error) == 0 && $insert_proyecto != false){?>
    <div class="materialert success">
		    <div class="material-icons">check</div>
		        Formulario guardado correctamente 
		    </div>
    </div>
    <?php } ?>
 
    <form action="alta-proyectos.php" method="POST" enctype="multipart/form-data" >
    
        <div class="form-floating">
            <input class="form-control" type="text" name="nombre" id="nombre" class="validate" <?php setValueField($error, "nombre")?>>
            <label for="nombre">Nombre:</label>
            <?php echo validation_errors($error,"nombre") ?>
        </div>

        <div class="form-floating">
            <select name="cliente" id="clientes" class="select2 form-select form-select-lg" data-allow-clear="true" >
                <option value="" <?php setValueField($error, "cliente")?> disabled selected>Select a option</option>
                <?php 
                $sql2 = "SELECT * FROM clientes";
                $clientes= mysqli_query($db, $sql2);
                while($cliente = mysqli_fetch_assoc($clientes)){ ?>
                    <option value="<?=$cliente['cliente_id']?>"> <?=$cliente['empresa']?></option>
                <?php } ?>
            </select>
            <label for="cliente">Clientes</label>
            <?php echo validation_errors($error, "clientes"); ?>
        </div>

        <div class="form-floating">
        <textarea class="form-control" class="materialize-textarea" id="descripcion" name="descripcion" class="validate" ><?php setValueField($error, "descripcion", true)?></textarea>
        <label for="descripcion">Descripción:</label>
        <?php echo validation_errors($error, "descripcion"); ?>
        </div> 
        <!--<div class="file-field input-field col s6">
            <div class="btn">
                <span>Imagen Destacada</span>
                <input type="file" name="destacada">
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" name="destacada" type="text" placeholder="Sube tu foto">
            </div>
        </div>-->
        
        <div class="form-floating">
            <input class="form-control" type="text" name="link" id="link" class="validate" <?php setValueField($error, "link")?>>
            <label for="link">Link del proyecto:</label>
            <?php echo validation_errors($error,"link"); ?>
        </div>

        <div class="form-floating">
        <input class="form-control"  type="text"  name="fecha_inicio" id="fecha-inicio" placeholder="YYYY-MM-DD" <?php setValueField($error, "fecha_inicio")?>>
            <label for="fecha_inicio">Fecha de inicio</label>
            <?php echo validation_errors($error,"fecha_inicio"); ?>
        </div>
        
        <div class="form-floating">
        <input class="form-control" type="text"  name="fecha_fin" id="fecha-fin" placeholder="YYYY-MM-DD" <?php setValueField($error, "fecha_fin")?>>
            <label for="fecha_fin">Fecha de Termino</label>
            <?php echo validation_errors($error,"fecha_fin"); ?>
        </div>

        <div class="form-floating"> 
            <select name="estado" id="estado" <?php setValueField($error, "estado")?> class="select2 form-select form-select-lg" data-allow-clear="true">
                <option value="" disabled selected>Selecciona una opcion</option>
                <option value="1">Pendiente</option>
                <option value="2">En Progreso</option>
                <option value="3">Pausado</option>
                <option value="4">Terminado</option>
                <option value="5">En Pruebas</option>
                <option value="6">Entregado</option>
            </select>
            <label for="estado">Estado</label>
            <?php echo validation_errors($error, "estado"); ?>
        </div>

        

        <div class="form-floating"> 
            <select name="tipo_proyecto" id="tipo_proyecto" class="select2 form-select form-select-lg" data-allow-clear="true">
                <option value="" <?php setValueField($error, "tipo_proyecto")?> disabled selected>Select a option</option>
                <?php 
                //consulta para recuperar la informacion dela tabla canchas y mostrarla en las opciones select del formulario
                $sql2 = "SELECT * FROM cat_proyectos";
                $result= mysqli_query($db, $sql2);
                while($tipo_pro = mysqli_fetch_assoc($result)){ ?>
                    <option value="<?=$tipo_pro['cat_id']?>"> <?=$tipo_pro['tipo']?></option>
                <?php } ?>
            </select>
            <label for="tipo_proyecto">Tipo proyecto</label>
            <?php echo validation_errors($error, "tipo_proyecto"); ?>
        </div>

        <div class="input-field col s6">    
            <input class="waves-effect waves-light btn" type="submit" name="submit" value="Guardar usuario" >
        </div>    
    </form>
    <form action="/file-upload" class="dropzone">
    <div class="dropzone needsclick" id="dropzone-multi">
            <div class="dz-message needsclick">
                Drop files here or click to upload
            </div>
            <div class="fallback">
                <input name="destacada" type="file" />
            </div>    
        </div>
    </form>
    </div> 
    
</div>

<?php 
require_once 'includes/footer.php';
?>

<script type="text/javascript">
   var flatpickrDate = document.querySelector("#fecha-inicio");
    flatpickrDate.flatpickr({
    monthSelectorType: "static"
}); 
    var flatpickrDate = document.querySelector("#fecha-fin");
    flatpickrDate.flatpickr({
    monthSelectorType: "static"
}); 
</script>
<script>
const myDropzone = new Dropzone('.dropzone', {

  parallelUploads: 1,
  maxFilesize: 5,
  addRemoveLinks: true,
  maxFiles: 1
});
</script>


<?php 
//include 'includes/redirect.php';
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
    $cliente_id = $_GET["id"];
    $cliente_query = mysqli_query($db, "SELECT * FROM clientes WHERE cliente_id = {$cliente_id}");
    $cliente = mysqli_fetch_assoc($cliente_query);
}

$proyectos = mysqli_query($db, "SELECT * FROM proyectos WHERE cliente_id = {$cliente_id}"); 

//if(!isset($user["user_id"]) || empty($user["user_id"])){
   // header("Location: jugadores.php");
//}

// validar formulario
$error = array();
if(isset($_POST["submit"])){
    
    if(!empty($_POST["nombre"]) && strlen($_POST["nombre"]) <= 50){
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

    if(!empty($_POST["empresa"])){
        $empresa_validate = true;
    }else{
        $empresa_validate = false;
        $error["empresa"] = "El linnombre de la emprsa no es valido";
    }
    if(!empty($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
        $email_validate = true;
    }else{
        $email_validate = false;
        $error["email"] = "No es un email valido";
    }

      if(isset($_POST["telefono"]) && is_numeric($_POST["telefono"])){
        $telefono_validate = true;
      }else{
          $telefono_validate = false;
          $error["telefono"] = "Selecciona un telefono";
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
        $sql = "UPDATE clientes SET  nombre = '{$_POST["nombre"]}',"
        ." apellido = '{$_POST["apellido"]}',"
        ." empresa = '{$_POST["empresa"]}',";
        
        if(isset($_FILES["imagen"]) && !empty($_FILES["imagen"]["tmp_name"])){
            $sql.="imagen = '{$imagen}',";
        }

        $sql.= "email = '{$_POST["email"]}',"
        ."telefono = '{$_POST["telefono"]}' WHERE cliente_id = {$cliente_id}";
       
        $update_cliente = mysqli_query($db, $sql);
       

        if($update_cliente){
            $cliente_query = mysqli_query($db, "SELECT * FROM clientes WHERE cliente_id = {$cliente_id}");
            $cliente = mysqli_fetch_assoc($cliente_query);
        }
        
    } else{
        $update_cliente = false;
    }

}   

?>
 <!-- crear un formulario para los campos "nombre" "apellido" "biografia"
    "email" "imagen" "contraseña" "rol" -->

    <?php 
        if(isset($_POST["submit"]) && count($error) == 0 && $update_cliente != false){?>
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
<div class="card text-center">
    <div class="card-header">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
            <button type="button" class="nav-link active" data-bs-toggle="tab" data-bs-target="#perfil" role="tab">Perfil</button>
            </li>
            <li class="nav-item">
            <button type="button" class="nav-link" data-bs-toggle="tab" data-bs-target="#proyectos" role="tab">Proyectos</button>
            </li>
        </ul>
    </div>
   
    <div class="card-body">
        <div class="tab-pane fade show active" id="perfil" role="tabpanel">
            <h3 class="card-title">Cliente: <?php echo $cliente["nombre"]." ".$cliente["apellido"]; ?></h3>
            <div class="col s12 m4 l4">
                    <img src="uploads/<?= $cliente['imagen'] ?>" class="responsive-img" >
            </div>
            <form action="" method="POST" enctype="multipart/form-data" class="col-12">
            
                <div class="form-floating">
                    <input class="form-control" type="text" name="nombre" id="nombre" class="validate" <?php setValueField($cliente, "nombre")?>>
                    <label for="nombre">Nombre:</label>
                    <?php echo validation_errors($error,"nombre") ?>
                    
                </div>
                
                <div class="form-floating">
                    <input class="form-control"  type="text" name="apellido" id="apellido" class="validate" <?php setValueField($cliente, "apellido")?>>
                    <label for="apellido">Apellido:</label>
                    <?php echo validation_errors($error,"apellido"); ?>
                </div>

                <div class="form-floating">
                    <input class="form-control"  type="text" name="empresa" id="empresa" class="validate" <?php setValueField($cliente, "empresa")?>>
                    <label for="apellido">Empresa:</label>
                    <?php echo validation_errors($error,"apellido"); ?>
                </div>

                <div class="form-floating">
                    <input class="form-control"  type="text" name="email" id="email" class="validate" <?php setValueField($cliente, "email")?>>
                    <label for="email">E-mail:</label>
                    <?php echo validation_errors($error, "email"); ?>
                </div>

                <div class="form-floating">
                    <input class="form-control"  type="text" name="telefono" id="telefono" class="validate" <?php setValueField($cliente, "telefono")?>>
                    <label for="email">Teléfono:</label>
                    <?php echo validation_errors($error, "telefono"); ?>
                </div>

                <!--<div class="file-field input-field col s6">
                    <div class="btn">
                        <span>Imagen</span>
                        <input type="file" name="imagen">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" name="imagen" type="text" placeholder="Sube tu foto">
                    </div>
                </div>-->
                <div class="input-field col s6">    
                    <input class="waves-effect waves-light btn" type="submit" name="submit" value="Guardar usuario" >
                </div>    
            </form>
            <form action="/upload" class="dropzone needsclick" id="dropzone-basic">
                    <div class="dz-message needsclick">
                        Drop files here or click to upload
                        <span class="note needsclick">(This is just a demo dropzone. Selected files are <span class="fw-medium">not</span> actually uploaded.)</span>
                    </div>
                    <div class="fallback">
                        <input name="file" type="file" />
                    </div>
            </form>
        </div>

        <div class="tab-pane fade" id="proyectos" role="tabpanel">
            <h3>Proyecto: <?php echo $cliente["nombre"]." ".$cliente["apellido"]; ?></h3>
            <table class="striped responsive-table">
                <thead class="teal accent-3">
                <tr>
                    <th></th>
                    <th>Nombre</th>
                    <th>Fecha inicio</th>
                    <th>Fecha Fin</th>
                    <th>Tipo de Proyecto</th>
                    <th>Estatus del Proyecto</th>
                </tr>
                </thead>    
                <tbody class="">      
                    <?php while ($proyecto = mysqli_fetch_assoc($proyectos)) { ?>
                        <tr>
                            <td><img class="circle responsive-img" width="50px" height="50px" 
                            src="uploads/<?php 
                            if ($proyecto['destacada'] == null || $proyecto['destacada'] == '') {
                                echo "default.png";
                            } else {
                                echo $proyecto['destacada'];
                            }
                            
                            ?>" > </td>
                            <td><a href="proyecto.php?id=<?= $proyecto['proyecto_id']?>"><?= $proyecto['nombre']?></a></td>
                            <td><?= $proyecto['fecha_inicio'] ?></td>
                            <td><?= $proyecto['fecha_fin'] ?></td>
                            <td><?php // mostrar el campo tipo tomando la columna tipo de la tabla cat proyecto dentro de deste campo de la tabla
                            if ($proyecto['cat_id']){
                            $tipo_proyecto = mysqli_query($db, "SELECT * FROM cat_proyectos WHERE cat_id = {$proyecto['cat_id']}");
                            $tipo_proyect = mysqli_fetch_assoc($tipo_proyecto);
                            echo  $tipo_proyect['tipo'] ;}
                            ?></td>
                            <td><?php if($proyecto['estado'] == 1){
                                echo "Pendiente";
                            }elseif ($proyecto['estado'] == 2){
                                echo "En progresso";
                            }elseif ($proyecto['estado'] == 3){
                                echo "Pausado";
                            }elseif ($proyecto['estado'] == 4){
                                echo "Terminado";
                            }elseif ($proyecto['estado'] == 5){
                                echo "En pruebas";
                            }elseif ($proyecto['estado'] == 6){
                                echo "Entregado";
                            }

                            ?></td>
                        </tr> 
                    <?php }?>
                    </tbody>
                </table>
        </div>
    </div>
</div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  


<?php 
require_once 'includes/footer.php';
?>
<script type="text/javascript">
  $(document).ready(function() {
    M.updateTextFields();
    $('select').formSelect();
});
 
document.addEventListener('DOMContentLoaded', function() {
    var tabsElement = document.querySelector('.tabs');
    var instance = M.Tabs.init(tabsElement);

    // Lógica para cambiar la pestaña activa
    // Por ejemplo, para cambiar a la segunda pestaña (el índice comienza en 0)
    instance.select('info_gen'); // Reemplaza 'tab_id' con el ID de la pestaña que quieres activar
    
    // Actualizar el indicador de la pestaña activa
    instance.updateTabIndicator();
});

const myDropzone = new Dropzone('#dropzone-basic', {
  previewTemplate: previewTemplate,
  parallelUploads: 1,
  maxFilesize: 5,
  addRemoveLinks: true,
  maxFiles: 1
});

</script>

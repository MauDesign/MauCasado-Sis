
<div class="container">
    <!-- crear un formulario para los campos "nombre" "apellido" "biografia"
    "email" "imagen" "contraseña" "rol" -->
    <?php //echo validation_errors(); ?>
    <form action="" method="POST" enctype="multip
    art/form-data">
    <h1>Crear Usuario</h1><br /><br />
    Nombre:
    <input type="text" name="nombre" id="nombre"><br /><br />
    Apellido:
    <input type="text" name="apellido" id="apellido"><br /><br />
    Biografía:
    <textarea rows="4" cols="50" name="biografia"></textarea><br /><br />
    Email:
    <input type="text" name="email" id="email"><br /><br />
    Imagen:
    <input type="file" name="archivo" size="20"/><br/><br/>
    Contraseña:
    <input type="password" name="pass" id="pass"><br /><br />
    Rol:
    <select name="rol">
        <option value="administrador">Administrador</option>
        <option value="editor">Editor</option>
        <option value="redactor">Redactor</option>
        </select><br /><br />
        <input type="submit" value="Guardar usuario" >
        </form>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function(){
            $("#pass").hide();
            $("button").click(function(){
            if($("#showPassword").is(":checked")){
            $("#pass").show();
            }else{
            $("#pass").hide();
            }
            });
            });
            </script>
            <label for="showPassword">Mostrar contraseña</label>
            <input type="checkbox" id="showPassword">
            <br/>
            <br/>
            <a href="" class="btn btn-primary">Volver
            a la lista de usuarios</a>
</div>

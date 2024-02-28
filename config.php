<?php 
require_once "includes/connect.php";

$sql = "CREATE TABLE IF NOT EXISTS inbox_clientes(
        id_inbox int(255) auto_increment not null,
        nombre varchar(59),
        telefono int(59),
        correo varchar(100),
        asunto varchar(80),
        mensaje text,
        PRIMARY KEY (id_inbox)
);";

$create_inbox_table = mysqli_query($db, $sql);
if ($create_inbox_table){
    echo "Las tabla INBOX clientes  se ha creado correctamente".'<br>';
}else{
    echo "No se ha creado las tablas proyectos clientes tipo proyectos";
} 


$sql = "CREATE TABLE IF NOT EXISTS users(
        user_id int(255) auto_increment not null,
        nombre varchar(59),
        apellido varchar(59),
        biografia text,
        email varchar(100),
        pass varchar(255),
        rol varchar(20),
        imagen varchar(255),
        PRIMARY KEY (user_id)
);";

$create_user_table = mysqli_query($db, $sql);

if ($create_user_table){
    echo "La tabla usuarios se ha creado correctamente" .'<br>';
}else{
    echo "No se ha creado la tabla";
}   



// alter tabla ppara que el campo de pass pueda recibir ahasta 255 caracteres
//$alter_pass = "ALTER TABLE users MODIFY COLUMN `pass` VARCHAR(255)";
//mysqli_query($db,$alter_pass);

  
/*
 $alter_pass = "ALTER TABLE clubs ADD COLUMN 
 imagen VARCHAR(255),
 phone VARCHAR(255),
 facebook VARCHAR(255),
 instragram VARCHAR(255),
 Canchas INT(255)";
mysqli_query($db,$alter_pass);
*/
$sql = "CREATE TABLE IF NOT EXISTS clubs(
    club_id INT(255) NOT NULL AUTO_INCREMENT , 
    club_name VARCHAR(255),
    imagen VARCHAR(255),
    phone VARCHAR(255),
    facebook VARCHAR(255),
    instragram VARCHAR(255),
    Canchas INT(255),
    PRIMARY KEY (club_id)
    );";

$create_clubs_table = mysqli_query($db, $sql);
if ($create_clubs_table){
    echo "La tabla Clubs se ha creado correctamente".'<br>';
}else{
    echo "No se ha creado la tabla";
}

// crear tabla  retas

$sql = "CREATE TABLE IF NOT EXISTS retas(
    reta_id int(255) auto_increment not null,
    club int(255),
    fecha date,
    hora time,
    canchas int(255),
    PRIMARY KEY (reta_id),
    FOREIGN KEY (club) REFERENCES clubs(club_id)
    );";

$create_retas_table = mysqli_query($db, $sql);
    if ($create_retas_table){
        echo "La tabla RETAS se ha creado correctamente".'<br>';
    }else{
        echo "No se ha creado la tabla retas";
    }  



// crear tabla de clientes qu econtenga id nombre y apellido empresa imagen
$sql = "CREATE TABLE IF NOT EXISTS clientes(
    cliente_id int(255) auto_increment not null,
    nombre varchar(255),
    apellido varchar(255),
    empresa varchar(255),
    imagen varchar(255),
    PRIMARY KEY (cliente_id)
    );";
$create_clientes_table = mysqli_query($db, $sql);
    if ($create_clientes_table){
        echo "Las tabla Clientes  se ha creado correctamente".'<br>';
    }else{
        echo "No se ha creado las tablas proyectos clientes tipo proyectos";
    } 
 
// crear tabbla cat_proyectos que contenga id y tipo de proyecto
$sql = "CREATE TABLE IF NOT EXISTS cat_proyectos(
    proyecto_cat_id int(255) auto_increment not null,
    tipo varchar(255),
    PRIMARY KEY (proyecto_cat_id)
    );";

$create_catproyect_table = mysqli_query($db, $sql);
if ($create_catproyect_table){
    echo "Las tabla CAT proyectos  se ha creado correctamente".'>br>';
}else{
    echo "No se ha creado las tablas proyectos clientes tipo proyectos";
} 


//crear tabala proyectos que contenga ID, nombre, descripcion, imagenimagen destacada, link, fecha de inicio, fecha de fin, estado y se relaciones con id de usuario y de cliente relacion tipo de proyecto, capacidad para mostrar galeria de imagenes o relacionar varias iamgenes
$sql = "CREATE TABLE IF NOT EXISTS proyectos(
    proyecto_id int(255) auto_increment not null,
    nombre varchar(255),
    descripcion text,
    destacada varchar(255),
    link varchar(255),
    fecha_inicio date,
    fecha_fin date,
    estado varchar(255),
    user_id int(255),
    cliente_id int(255),
    proyecto_cat_id int(255),
    PRIMARY KEY (proyecto_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (cliente_id) REFERENCES clientes(cliente_id),
    FOREIGN KEY (proyecto_cat_id) REFERENCES cat_proyectos(proyecto_cat_id)
    );";

$create_proyectos_table = mysqli_query($db, $sql);
if ($create_proyectos_table){
    echo "Las tabla proyectos   se ha creado correctamente";
    echo mysqli_error($db);
}else{
    echo "No se ha creado las tablas proyectos ";
}  




?>
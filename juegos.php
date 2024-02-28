<?php 
include 'includes/redirect.php';
require_once 'includes/side.php';
$playerCount = 0;
$numero_canchas = 0;
function insertarMarcador($conexion, $id_reta, $pareja_a, $pareja_b, $cancha, $puntos_a, $puntos_b) {
    $query_insertar = "INSERT INTO juegos (id_reta, pareja_a, pareja_b, cancha, puntos_pareja_a, puntos_pareja_b)
                       VALUES ($id_reta, '$pareja_a', '$pareja_b', $cancha, $puntos_a, $puntos_b)";
    mysqli_query($conexion, $query_insertar);
    // Verificar si la inserción fue exitosa o manejar errores si es necesario
}

// Asignar parejas a cada cancha e ingresar los marcadores de puntos en la tabla juegos
$parejas_por_cancha = [];
for ($i = 0; $i < $numero_canchas; $i++) {
    $pareja_a = generarParejaUnica($jugadores, $parejas_por_cancha);
    $pareja_b = generarParejaUnica($jugadores, $parejas_por_cancha);

    // Simular puntos aleatorios (puedes modificar esta lógica según sea necesario)
    $puntos_pareja_a = rand(0, 10);
    $puntos_pareja_b = rand(0, 10);

    // Mostrar las parejas y los puntos (para verificación, puedes quitar esto en producción)
    echo "Cancha " . ($i + 1) . ": " . implode(' - ', $pareja_a) . ", " . implode(' - ', $pareja_b) . "<br>";
    echo "Puntos Pareja A: $puntos_pareja_a, Puntos Pareja B: $puntos_pareja_b<br>";

    // Insertar marcador en la tabla juegos
    insertarMarcador($conexion, $id_reta, implode(' - ', $pareja_a), implode(' - ', $pareja_b), $i + 1, $puntos_pareja_a, $puntos_pareja_b);
}

if(isset($_GET["id"])){
    $reta_id = $_GET["id"];
    $reta_query = mysqli_query($db, "SELECT * FROM retas WHERE reta_id = {$reta_id}");
    $reta = mysqli_fetch_assoc($reta_query);
}
?>
<?php

// Obtener el número de canchas desde la tabla retas (asumiendo que ya tienes el $id_reta)
$query_retas = "SELECT Canchas FROM retas WHERE reta_id = $reta_id";
$resultado_retas = mysqli_query($db, $query_retas);
$numero_canchas = mysqli_fetch_assoc($resultado_retas)['Canchas'];

// Obtener los nombres de los jugadores desde la tabla jugadores
$query_jugadores = "SELECT nombre_jugador FROM jugadores";
$resultado_jugadores = mysqli_query($db, $query_jugadores);

$jugadores = [];
while ($fila = mysqli_fetch_assoc($resultado_jugadores)) {
    $jugadores[] = $fila['nombre_jugador'];
}

// Función para generar una pareja aleatoria y única
function generarParejaUnica($jugadores, &$parejas_previas) {
    $jugador1 = $jugador2 = null;
    $intentos_maximos = 100;

    while ($intentos_maximos > 0) {
        $intentos_maximos--;

        $jugador1 = $jugadores[array_rand($jugadores)];
        $jugador2 = $jugadores[array_rand($jugadores)];

        if ($jugador1 !== $jugador2 && !parejaExiste($jugador1, $jugador2, $parejas_previas)) {
            break;
        }
    }

    if ($intentos_maximos === 0) {
        return "No se pudo generar una pareja única después de varios intentos";
    }

    $parejas_previas[] = [$jugador1, $jugador2];
    return [$jugador1, $jugador2];
}

// Función para verificar si la pareja ya existe en las parejas previas
function parejaExiste($jugador1, $jugador2, $parejas_previas) {
    foreach ($parejas_previas as $pareja) {
        if (in_array($jugador1, $pareja) || in_array($jugador2, $pareja)) {
            return true;
        }
    }
    return false;
}

// Asignar parejas a cada cancha

    // generar rondas  con parejas unicas dependidnedo del numero de canchas
    $rondas = $playerCount * ($playerCount - 1) / 2;
    // Calcular juegos por ronda
    $juegos_por_ronda = $playerCount / 2;
    // Obtener el número de canchas desde la tabla retas (asumiendo que ya tienes el $id_reta)
    $query_retas = "SELECT Canchas FROM retas WHERE reta_id = $reta_id";
    $resultado_retas = mysqli_query($db, $query_retas);
    $numero_canchas = mysqli_fetch_assoc($resultado_retas)['Canchas'];
    echo $playerCount.'<br>';
    echo $rondas.'<br>';
    echo $juegos_por_ronda.'<br>';
    echo $numero_canchas.'<br>';
    // Obtener los nombres de los jugadores desde la tabla jugadores
    $query_jugadores = "SELECT nombre_jugador FROM jugadores";
    $resultado_jugadores = mysqli_query($db, $query_jugadores);
    $jugadores =mysqli_fetch_assoc($resultado_jugadores);
    // Simular puntos aleatorios (puedes modificar esta lógica según sea necesario)
    $puntos_pareja_a = rand(0, 10);
    $puntos_pareja_b = rand(0, 10);
    $parejas_por_cancha = [];
    
    for ($i = 0; $i < $numero_canchas; $i++) {
        $pareja_a = generarParejaUnica($jugadores, $parejas_por_cancha);
        $pareja_b = generarParejaUnica($jugadores, $parejas_por_cancha);
    // Mostrar las parejas (para verificación, puedes quitar esto en producción)
    //echo "Cancha " . ($i + 1) . ": " . implode(' - ', $pareja_a) . ", " . implode(' - ', $pareja_b) . "<br>";

    // Formulario para ingresar los puntos de cada pareja
   
}
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
            <h5>Juegos</h5>
            <form method="POST" action="">
                <?php
                $parejas_por_cancha = [];
                for ($i = 0; $i < $numero_canchas; $i++) {
                    $pareja_a = generarParejaUnica($jugadores, $parejas_por_cancha);
                    $pareja_b = generarParejaUnica($jugadores, $parejas_por_cancha);
                    echo "Cancha " . ($i + 1) . ": " . implode(' - ', $pareja_a) . ", " . implode(' - ', $pareja_b) . "<br>";
                    echo implode(' - ', $pareja_a).": <input type='number' name='puntos_pareja_a[]' min='0' max='10'><br>";
                    echo implode(' - ', $pareja_b).": <input type='number' name='puntos_pareja_b[]' min='0' max='10'><br>";
                }
                ?>
                <input type='submit' value='Guardar'>
            </form>
        <?php




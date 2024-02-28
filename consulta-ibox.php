<?php

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "root", "MC_Data");

if ($conexion->connect_error) {
    die("Error en la conexión a la base de datos: " . $conexion->connect_error);
}

// Obtener la fecha de la última ejecución
$ultima_ejecucion = file_get_contents("ultima_ejecucion.txt");

// Consulta para obtener los nuevos registros
$sql = "SELECT * FROM inbox_clientes WHERE fecha_creacion > '$ultima_ejecucion'";

$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    // Hay nuevos registros
    while ($fila = $resultado->fetch_assoc()) {
        // Procesar los nuevos registros (enviar mensaje de WhatsApp, etc.)
        echo "**Nuevo registro:**" . PHP_EOL;
        echo "Nombre: " . $fila['nombre'] . PHP_EOL;
        echo "Correo: " . $fila['correo'] . PHP_EOL;
        echo "Mensaje: " . $fila['mensaje'] . PHP_EOL;
        echo "-----------------------" . PHP_EOL;
    }

    // Actualizar la fecha de la última ejecución
    file_put_contents("ultima_ejecucion.txt", date("Y-m-d H:i:s"));
} else {
    // No hay nuevos registros
    echo "No hay nuevos registros en la tabla inbox_clientes." . PHP_EOL;
}

$conexion->close();

?>
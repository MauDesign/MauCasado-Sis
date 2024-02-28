<?php
// Check if the form has been submitted
if (isset($_POST['submit'])) {
    $nombre = limpiarEntrada($_POST['nombre']);
    $telefono = limpiarEntrada($_POST['telefono']);
    $correo = limpiarEntrada($_POST['correo']);
    $asunto = limpiarEntrada($_POST['Asunto']);
    $mensaje = limpiarEntrada($_POST['mensaje']);

    // Enviar correo
    $destino = "diseno@mauriciocasado.com";
    $asuntoCorreo = "Nuevo mensaje de contacto: $asunto";
    $cuerpoCorreo = "Nombre: $nombre\nTeléfono: $telefono\nCorreo: $correo\nMensaje: $mensaje";

    $headers = "From: $correo\r\n";

    if (mail($destino, $asuntoCorreo, $cuerpoCorreo, $headers)) {
        // Conexión a la base de datos
        $conexion = new mysqli("localhost", "mauriciocasa", "Des@rr0ll02o24", "mauriciocasa");

        if ($conexion->connect_error) {
            die("Error en la conexión a la base de datos: " . $conexion->connect_error);
        }

        // Consulta preparada para evitar inyección de SQL
        $sql = "INSERT INTO inbox_clientes (nombre, telefono, correo, asunto, mensaje) VALUES (?, ?, ?, ?, ?)";

        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sssss", $nombre, $telefono, $correo, $asunto, $mensaje);
       
       if ($stmt->execute()) {
            // Éxito al guardar datos en la base de datos
            header("Location: ../../index.php"); // Redirige a una página de éxito
            exit();
        } else {
            // Error al guardar datos en la base de datos
            header("Location: error.php"); // Redirige a una página de error
            exit();
        }
       

        $stmt->close();
        $conexion->close();
    } else {
        echo "Error al enviar el correo.";
    }
} else {
    echo "Acceso no permitido.";
}

// Función para limpiar datos
function limpiarEntrada($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>


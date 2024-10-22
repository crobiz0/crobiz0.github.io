<?php
require("conexion.php");

if (isset($_POST["usuario_id"], $_POST["nuevo_estado"])) {
    $usuario_id = intval($_POST["usuario_id"]);  // Convertimos el ID a entero para limpiarlo
    $nuevo_estado = intval($_POST["nuevo_estado"]);  // Aseguramos que el estado sea entero (0 o 1)

    // Asegurarse de que los valores sean solo 1 o 0
    if ($nuevo_estado !== 1 && $nuevo_estado !== 0) {
        echo json_encode(['mensaje' => 'Estado no válido']);
        exit;
    }

    $sql = "UPDATE usuarios SET ESTA_BLOQUEADO = $nuevo_estado WHERE ID_USUARIO = $usuario_id";
    $resultado = mysqli_query($con, $sql);

    if ($resultado) {
        echo json_encode(['mensaje' => 'Estado actualizado correctamente']);
    } else {
        echo json_encode(['mensaje' => 'Error al actualizar el estado']);
    }
} else {
    echo json_encode(['mensaje' => 'Datos incompletos']);
}
?>

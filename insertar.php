<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webcam_db";

// Crea una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica si la conexión es exitosa
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

// Obtiene el texto ingresado por el usuario desde el formulario
$orden= $_POST["orden"];
$sku= $_POST["sku"];

// Crea una consulta SQL para insertar el texto en la tabla correspondiente
$sql = "INSERT INTO tbl_image (orden, sku) VALUES ('$orden','$sku')";

// Ejecuta la consulta SQL
if ($conn->query($sql) === TRUE) {
  echo "Registro insertado correctamente";
} else {
  echo "Error al insertar el registro: " . $conn->error;
}

// Cierra la conexión a la base de datos
$conn->close();
?>

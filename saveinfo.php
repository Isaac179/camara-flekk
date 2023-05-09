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

if(isset($_FILES["webcam"]["tmp_name"])) {
    $tmpName = $_FILES["webcam"]["tmp_name"];
    $imageName = date("Y.m.d") . " - " . date("h.i.sa") . '.jpeg';
    date_default_timezone_set("America/Mexico_City");
    move_uploaded_file($tmpName, 'img/' . $imageName);
    $date = date("Y/m/d") . " & " .date("h:i:sa");

    $query = "INSERT INTO tbl_image VALUES('','$date','$imageName','','')";
    $conn->query($query);
    echo $conn->insert_id;
    /*
    // Obtiene el texto ingresado por el usuario desde el formulario
    $orden= $_POST["orden"];
    $sku= $_POST["sku"];

    // Crea una consulta SQL para insertar el texto en la tabla correspondiente
    $sql = "UPDATE INTO tbl_image (date, image, orden, sku) VALUES ('','$date','$imageName','$orden','$sku')";

    // Ejecuta la consulta SQL
    if ($conn->query($sql) === TRUE) {
    echo "Registro insertado correctamente";
    }*/

} 

if(isset($_POST["orden"])&&isset($_POST["sku"])&&isset($_POST["idrecord"])) {
    $orden= $_POST["orden"];
    $sku= $_POST["sku"];
    $id= $_POST["idrecord"];
    $query = "UPDATE tbl_image SET orden='$orden', sku='$sku' WHERE id='$id'";
    $conn->query($query);
    echo "Registro actualizado correctamente";
}

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


<?php require 'function.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registros flekk</title>

    <style media="screen">
        a button {
            padding: 12px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-size: 16px;
            background: #70b3b8;
            color: white;
        }
    </style>
</head>
<body><br><br>  
<a href="../camara-flekk"><button type="button" name="button">Tomar nuevo registro</button></a><br><br>
    <table border = 1 cellspacing = 0 cellpadding = 10>
        <tr>
            <td>ID</td>
            <td>Hora de captura</td>
            <td>Imagenes</td>
            <td>Numero de orden</td>
            <td>SKU</td>
        </tr>

        <?php 
            $i = 1;
            $rows = mysqli_query($conn, "SELECT * FROM tbl_image ORDER BY id DESC");
        ?>

        <?php foreach($rows as $row) : ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row["date"] ?></td>
            <td><img src="img/<?php echo $row["image"] ?>" width=200 title="<?php echo $row["image"] ?>"></td>
            <td><?php echo $row["orden"] ?></td>
            <td><?php echo $row["sku"] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br>
    
    <a href="../camara-flekk"><button type="button" name="button">Tomar nuevo registro</button></a>
</body>
</html>


<?php
//Mostrar la hora de Madrid.
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
?>

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
            <td>FECHA</td>
            <td>N° ORDEN</td>
            <td>SKU</td>
            <td>IMAGEN 1</td>
            <td>IMAGEN 2</td>
            <td>IMAGEN 3</td>
        </tr>

        <?php 
            $i = 1;
            $rows = mysqli_query($conn, "SELECT * FROM tbl_image ORDER BY id DESC");
        ?>

        <?php foreach($rows as $row) : ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $row["date"] ?></td>
            <td><?php echo $row["orden"] ?></td>
            <td><?php echo $row["sku"] ?></td>
            <td><img src="img/<?php echo $row["image"] ?>" width=200 title="<?php echo $row["image"] ?>"></td>
            <td><img src="img/<?php echo $row["image2"] ?>" width=200 title="<?php echo $row["image2"] ?>"></td>
            <td><img src="img/<?php echo $row["image3"] ?>" width=200 title="<?php echo $row["image3"] ?>"></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <br>
    
    <a href="../camara-flekk"><button type="button" name="button">Tomar nuevo registro</button></a>
</body>
</html>



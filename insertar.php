<?php
$conn = mysqli_connect("localhost","root","","webcam_db");
$orden= $_POST["orden"];
$sku= $_POST["sku"];
if(isset($_FILES["webcam"]["tmp_name"])) {
    $orden= $_POST["orden"];
    $tmpName = $_FILES["webcam"]["tmp_name"];
    $imageName = date("Y.m.d") . " - " . date("h.i.sa") . '.jpeg';
    move_uploaded_file($tmpName, 'img/' . $imageName);
    $date = date("Y/m/d") . " & " .date("h:i:sa");
    $o = $orden;
    $s= $sku;

    $query = "INSERT INTO tbl_image VALUES('','$date','$imageName','$o','$s')";
    mysqli_query($conn, $query);
    
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
            <td>FOTOS</td>
            <td>N° ORDEN</td>
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



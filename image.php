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
<body>
<a href="../camara-flekk"><button type="button" name="button">Tomar nuevo registro</button></a><br><br>
    <table border = 1 cellspacing = 0 cellpadding = 10>
        <tr>
            <td>ID</td>
            <td>Hora de captura</td>
            <td>Imagenes</td>
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
        </tr>
        <?php endforeach; ?>
    </table>
    <br>
    
    <a href="../camara-flekk"><button type="button" name="button">Tomar nuevo registro</button></a>
</body>
</html>
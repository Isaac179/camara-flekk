<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Captura evidencias autopartes</title>
  <link rel="stylesheet" href="./app.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body onload="configure();">
  <header><h1>Registro de refacciónes</h1></header>
  <main><br><br>
    <div style="align-items: center; display: flex;flex-direction: column;">
    <input style="padding: 5px;width: 300px;text-transform:uppercase;border-radius: 20px;" placeholder="Ingresa Referencia pedido: ZSBSGIELC" type="text"><br>
        <div id="my_camera">
        </div>
        <div id="results" style="visibility: hidden; position: absolute;">
        </div>
    </div><br>
    <div class="container" style="text-align: center;">
      <button type="button SUBMIT" onclick="saveSnap();">Tomar foto</button>
      <a href="image.php"><button type="button" name="button">Ver base de imagenes&#x2192;</button> </a>  </div>
    <div><br></div>
  </main>
  <footer>
    <p>flekk camara
      <a href="mailto:icalderon@flekk.com">@webmaster</a>
    </p>
  </footer>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.js"></script>
  <script src="main.js"></script>
</body>
</html>
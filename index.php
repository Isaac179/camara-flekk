<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Captura evidencias autopartes</title>
  <link rel="stylesheet" href="./app.css" />

</head>

<body>

  <header>
    <h1>Registro de refacciónes</h1>
  </header>

  <main>
    <div class="controls">
      <button id="button">Seleccionar camara</button>
      <select id="select">
        <option></option>
      </select>
    </div>
<br><br>
    <video id="video" autoplay playsinline poster="https://flekk.com/img/cms/3autopartes_flekk_los_mejores_precios_2023.png";></video>
    
    <div class="container" style="text-align: center;">
      <br>
      <button type="button" onclick="saveSnap();">Tomar foto</button>
      <a href="image.php"><button type="button" name="button">Ver base de imagenes&#x2192;</button> </a>  </div>
<div><br></div>
  </main>
  <footer>
    
    <p>flekk camara
      <a href="mailto:icalderon@flekk.com">@webmaster</a>
    </p>
  </footer>

  <script src="./app.js"></script>
</body>

</html>
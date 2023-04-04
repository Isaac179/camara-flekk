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

    <video id="video" autoplay playsinline></video>
    
    <div class="container">

      <br>
      <button type="button" onclick="saveSnap();">Tomar Foto</button><br><br>
      <a href="image.php"><button type="button" name="button">Ver base de imagenes&#x2192;</button> </a>
  </div>
  </main>
  <footer>
    <p>flekk camara
      <a href="https://flekk.com">@webmaster</a>
    </p>
  </footer>

  <script src="./app.js"></script>
</body>

</html>
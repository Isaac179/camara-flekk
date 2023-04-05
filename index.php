<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Captura evidencias autopartes</title>
  <link rel="stylesheet" href="./app.css" />

</head>

<body onload="configure();">

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
        
    <div class="container">
        <div id="my_camera" id="video">
        </div>
        <div id="results" style="visibility: hidden; position: absolute;">
            <!--<video id="video" autoplay playsinline poster="https://flekk.com/img/cms/3autopartes_flekk_los_mejores_precios_2023.png";></video>-->
        </div>
    </div>

    <br><br>
    <div class="container" style="text-align: center;">
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
  
<script type="text/javascript" src="assets/webcam.min.js"></script>

<script type="text/javascript">

    function configure() {
        Webcam.set({
            width: 480,
            height: 360,
            image_format: 'jpeg',
            jpeg_quality: 90
        });

        Webcam.attach('#my_camera');
    }

    function saveSnap() {
        Webcam.snap(function(data_uri){
            document.getElementById('results').innerHTML = 
                '<img id="webcam" src="'+data_uri+'">';
        });

        Webcam.reset();

        var base64image = document.getElementById("webcam").src;
        Webcam.upload(base64image,'function.php',function(code,text){
            alert('Save Successfully');
            document.location.href = "image.php"
        });

    }


</script>
</body>

</html>
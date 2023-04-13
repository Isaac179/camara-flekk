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
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>


</head>

<body onload="configure();">

  <header>
    <h1>Registro de refacciónes</h1>
  </header>

  <main>
    <div class="controls">
      <button style="color:#102f5b;" id="button">Seleccionar camara</button>
      <div class="mostrar visible-xs">
        <br>
      </div> 

      <select style="color:#102f5b;" id="camera-select">
      <option></option>
      </select>
    </div>
<br><br>
        
    <div style="align-items: center; display: flex;flex-direction: column;">
        <div id="my_camera">
        </div>
        <div id="results" style="visibility: hidden; position: absolute;">
            <!--<video id="video" autoplay playsinline poster="https://flekk.com/img/cms/3autopartes_flekk_los_mejores_precios_2023.png";></video>-->
        </div>
    </div>
    <br>
    <form  style="align-items: center; display: flex;flex-direction: column;" method="POST" action="function.php">
      <input type="TEXT" name="nombre" placeholder="Ingresa el SKU"><br>
    <br>
    <div class="container" style="text-align: center;">
      <button type="button SUBMIT" onclick="saveSnap();">Tomar foto</button>
      <a href="image.php"><button type="button" name="button">Ver base de imagenes&#x2192;</button> </a>  </div>
    <div><br></div>
  </form>
  </main>
  <footer>
    
    <p>flekk camara
      <a href="mailto:icalderon@flekk.com">@webmaster</a>
    </p>
  </footer>

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
            alert('Imagen guardada ✓ tomar otra?');
            document.location.href = "image.php"
        });

        

    }

    function change(){

      // Configura la cámara predeterminada
Webcam.set({
    width: 480,
    height: 360,
    image_format: 'jpeg',
    jpeg_quality: 90
});

// Obtiene las cámaras disponibles
Webcam.get().then(function(cameras) {
    // Muestra las opciones de cámara disponibles
    for (var i in cameras) {
        var camera = cameras[i];
        var option = document.createElement('option');
        option.value = camera.id;
        option.innerHTML = camera.name;
        document.getElementById('camera-select').appendChild(option);
    }
});

// Cambia la cámara cuando se selecciona una nueva opción
document.getElementById('camera-select').addEventListener('change', function() {
    var cameraId = this.value;
    Webcam.set({
        device: cameraId
    });
    Webcam.attach('#my_camera');
});

// Inicializa la cámara
Webcam.attach('#my_camera');

    }


</script>
</body>

</html>
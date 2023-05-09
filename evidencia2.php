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
  <header><h3> 3 INGRESA EL NÚMERO ORDEN</h3></header>
 
  <main><br><br>
    <div style="align-items: center; display: flex;flex-direction: column;">
    <form method="post" enctype="multipart/form-data">

      <input id="idrecord" type="hidden" value="<?= $_GET['idrecord'] ?>">

      <select id="orden2" name="orden" placeholder="Orden ejemplo: 7024" type="text" value="">
        <option value="">Seleccione una orden</option>
      </select><br><br>
      <input id="orden" name="orden" placeholder="Orden ejemplo: 7024" type="text" value=""><br><br>
      <input id="sku" name="sku" placeholder="SKU EJEMPLO: ZSBSGIELC" type="text" value="<?= $_GET['sku'] ?>"><br>
      

    </div><br>
    <div class="container" style="text-align: center;" id="botones">
      <button type="button" onclick="lastStep();" href="insertar.php"><b>ENVIAR AHORA&#x2192;</b></button><br><br>
      <a href="insertar.php"><button type="button" name="button">Ver base de imagenes&#x2192;</button> </a>  </div>
    <div><br></div>
    </form>
    
  </main>
  <footer>
    <p>flekk camara
      <a href="mailto:icalderon@flekk.com">@webmaster</a>
    </p>
  </footer>
  <script src="main.js"></script>

<script>
  $(document).ready(function() {
      // URL del API de Prestashop para obtener las últimas órdenes
      var url = "https://tienda-qa3.flekk.com/api/orders?sort=id_DESC&limit=10";

      // Credenciales de acceso al API (clave API)
      var apiKey = "GW94IHVKH8Z8RB25FJI89IHF2NCFLFPL";

      // Hacer la petición GET al API de Prestashop
      $.ajax({
        url: url,
        type: "GET",
        headers: { "Authorization": "Basic " + btoa(apiKey + ":") },
        success: function(response) {
          // Si la petición es exitosa, mostrar las órdenes en el elemento select
          var select = $("#orden");
          select.empty(); // Vaciar el elemento select
          select.append('<option value="">Seleccione una orden</option>');
          $.each(response.orders, function(i, order) {
            select.append('<option value="' + order.id + '">' + order.reference + '</option>');
          });
        },
        error: function(xhr, status, error) {
          // Si hay algún error, mostrarlo en la consola del navegador
          console.log("Error al obtener las órdenes de Prestashop: " + error);
        }
      });
    });
</script>

</body>
</html>
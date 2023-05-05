var localMediaStream = null;
var interval = null
var video = document.querySelector('video');
var stream_canvas = document.getElementById('stream-canvas')
var ctx = stream_canvas.getContext('2d')
var overlay_ctx = document.getElementById('overlay-canvas').getContext('2d')
var list = document.querySelector('ul#decoded');
var modal = document.getElementById('overlay')
var worker = new Worker('zbar-processor.js');

worker.onmessage = async function(event) {
    if (event.data.length == 0) return;
    var d = event.data[0];
    var entry = document.createElement('li');
    entry.appendChild(document.createTextNode(d[1] + ' (' + d[0] + ')'));
    list.appendChild(entry);
    drawPoly(overlay_ctx, d[2])
    renderData(overlay_ctx, d[1], d[2][0], d[2][1])
    await stop()
    
    document.getElementById('sku').value = d[1];
    window.location.href = "evidencia.php?sku=" + encodeURIComponent(d[1]);
    //document.getElementById('my_camera').style.display = 'block';
    //document.getElementById('botones').style.display = 'block';
    //document.getElementById('barcode').style.display = 'none';
};

function snapshot() {
    if (localMediaStream === null) return;
    ctx.imageSmoothingQuality = "high"
    ctx.filter = "brightness(98%)";
    ctx.drawImage(video, 0, 0, video.videoWidth, video.videoHeight,
                  0, 0, stream_canvas.width, stream_canvas.height);
    var data = ctx.getImageData(0, 0,stream_canvas.width, stream_canvas.height);
    worker.postMessage(data);

}


function start() {
    navigator.mediaDevices.getUserMedia(
        { video: 
          {
            facingMode: "environment"||"user",
            width:{min:640, ideal:1280,},
            height:{min:480,ideal:720,},
            aspectRatio:2,
            frameRate: { ideal: 25, max: 30 }
          }, 
        audio:false,
        }
      ).then((stream)=>{
        video.srcObject = stream
        localMediaStream = true
        modal.style.width = "100%"
        video.onloadedmetadata = (e)=> {video.play();}
            }).catch((error)=>alert(error))
   interval = setInterval(snapshot, 1000/3.777778);
}

function stop() {
      clearInterval(interval)
      localMediaStream = null
      video.srcObject.getTracks().forEach((track)=>{track.stop()})
      video.srcObject = null
      ctx.clearRect(0,0,stream_canvas.width, stream_canvas.height);
      modal.style.width = "0%"
}

function drawPoly(ctx, poly) {
    // drawPoly expects a flat array of coordinates forming a polygon (e.g. [x1,y1,x2,y2,... etc])
        ctx.beginPath();
        ctx.moveTo(poly[0], poly[1]);
        ctx.strokeStyle = "#00bfff";
        ctx.lineWidth = 2.3;
        // ctx.shadowColor = '#FFF';
        // ctx.shadowBlur = 3;
        for (item = 2; item < poly.length - 1; item += 2) { 
          ctx.lineTo(poly[item], poly[item + 1]) 
        }
        ctx.closePath();
        ctx.stroke();

    }

    // render the string contained in the barcode as text on the canvas
function renderData(ctx, data, x, y) {
        ctx.font = "15px Arial";
        ctx.fillStyle = "green";
        // ctx.fillText(data, x, y);
        setTimeout(()=>{
          ctx.clearRect(0, 0, stream_canvas.width, stream_canvas.height)
        },100)
    }

    //scripts camara evidencias

    function configure() {
      Webcam.set({
          width: 480,
          height: 360,
          image_format: 'jpeg',
          jpeg_quality: 90,
          constraints: {
              facingMode: 'environment'
          }
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
      Webcam.upload(base64image,'insertar.php',function(code,text){
          alert('Imagen guardada con exito');
          document.location.href = "insertar.php"
      });
  
  }
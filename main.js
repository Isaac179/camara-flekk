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
            // renderData(overlay_ctx, d[1], d[2][0], d[2][1] - 10)
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
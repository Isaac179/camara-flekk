const container = document.getElementById('container');
const button = document.getElementById('button');
const select = document.getElementById('select');
let currentStream;

function stopMediaTracks(stream, element) {
  stream.getTracks().forEach(track => {
    if (track.kind === 'video') {
      element.querySelector('video').srcObject = null;
    } else if (track.kind === 'audio') {
      track.stop();
    }
  });
}

function gotDevices(mediaDevices) {
  select.innerHTML = '';
  select.appendChild(document.createElement('option'));
  let count = 1;
  mediaDevices.forEach(mediaDevice => {
    if (mediaDevice.kind === 'videoinput') {
      const option = document.createElement('option');
      option.value = mediaDevice.deviceId;
      const label = mediaDevice.label || `Camera ${count++}`;
      const textNode = document.createTextNode(label);
      option.appendChild(textNode);
      select.appendChild(option);
    }
  });
} 

button.addEventListener('click', event => {
  if (typeof currentStream !== 'undefined') {
    stopMediaTracks(currentStream, container);
  }
  const videoConstraints = {};
  if (select.value === '') {
    videoConstraints.facingMode = 'environment';
  } else {
    videoConstraints.deviceId = { exact: select.value };
  }
  const constraints = {
    video: videoConstraints,
    audio: false
  };
  navigator.mediaDevices
    .getUserMedia(constraints)
    .then(stream => {
      currentStream = stream;
      const video = document.createElement('video');
      video.srcObject = stream;
      container.appendChild(video);
      return navigator.mediaDevices.enumerateDevices();
    })
    .then(gotDevices)
    .catch(error => {
      console.error(error);
    });
});

navigator.mediaDevices.enumerateDevices().then(gotDevices);

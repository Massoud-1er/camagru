var width = 720;
var height = 0;
var video = document.querySelector("#videoElement");
var canvas = document.getElementById('CANVAS');
var context = canvas.getContext('2d');

if (navigator.mediaDevices.getUserMedia) 
{       
    navigator.mediaDevices.getUserMedia({video: true})
  .then(function(stream) {
    video.srcObject = stream;
  })
  .catch(function(err0r) {
    console.log("Something went wrong!");
  });
function myFunction() {
  var ctx = canvas.getContext("2d");
  ctx.fillStyle = "#FF0000";
  ctx.drawImage(video, 0, 0, 500, 375);
  var data = canvas.toDataURL('image/png');
  data_img.setAttribute('value', data);
}
}


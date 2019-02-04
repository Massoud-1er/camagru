function download(){
    var download = document.getElementById("download");
    var image = document.getElementById("CANVAS").toDataURL("image/png")
                    .replace("image/jpg", "image/octet-stream");
        download.setAttribute("href", image);
        //download.setAttribute("download","archive.png");
  }
  var video = document.querySelector("#videoElement");
 
if (navigator.mediaDevices.getUserMedia) 
{       
    navigator.mediaDevices.getUserMedia({video: true})
  .then(function(stream) {
    video.srcObject = stream;
  })
  .catch(function(err0r) {
    console.log("Something went wrong!");
  });
var i=0;
function myFunction() {
  var x =  document.getElementById("CANVAS") ;
  var ctx = x.getContext("2d");
  ctx.fillStyle = "#FF0000";
  
  ctx.drawImage(video, 0, 0, 500, 375);
  if (i <10)
  {
  document.body.appendChild(x);
  i=i+1;
};
}
}
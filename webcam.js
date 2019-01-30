var video = document.querySelector("#videoElement");

if (navigator.mediaDevices.getUserMedia) {       
navigator.mediaDevices.getUserMedia({video: true})
.then(function(stream) {
video.srcObject = stream;
})
.catch(function(err0r) {
console.log("Something went wrong!");
});
}

function test() {
    var canvas = document.getElementById('canvas');
    var ctx = canvas.getContext('2d');
    var img = document.getElementById('videoElement');
    ctx.drawImage(img, 0, 0, 1000, 1400, 0, 0, 500, 375);
    console.log(ctx);
}

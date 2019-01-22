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
    var ctx = canvas.getContext('2d', { antialias: false, depth: false });
    ctx.drawImage(canvas,100,100);
    console.log(ctx);
}

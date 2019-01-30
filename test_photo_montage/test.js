var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');
var img1 = new Image();
var img2 = new Image();

img1.onload = function() {
    canvas.width = img1.width;
    canvas.height = img1.height;
    img2.src = 'https://raw.githubusercontent.com/wickedpool/Camagru-42/master/images/trash.png';
};
img2.onload = function() {
    context.globalAlpha = 1.0;
    context.drawImage(img1, 0, 0);
    context.globalAlpha = 1.0;
    context.drawImage(img2, 0, 0);
};        
img1.src = 'leonard.jpg';
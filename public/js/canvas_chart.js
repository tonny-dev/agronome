<!-- <canvas id="cnv_altitude_graphic" class="ml-10 mb-10"></canvas> -->
<script>
var canvas = document.getElementById("cnv_altitude_graphic");
canvas.width = 800;
canvas.height = 300;

//   canvas.style.backgroundColor = "beige";

var ctx = canvas.getContext("2d");

ctx.moveTo(0, 150);
ctx.fillStyle = 'green';
ctx.lineWidth = 0.5;
ctx.lineTo(canvas.width, 150);


drawLine(ctx, 0, 150, canvas.width, 150, 'green');

//farm altitude

ctx.fillStyle = 'black';

ctx.lineWidth = 1;

ctx.font = '15px serif';
ctx.fillText('1,100 masl', canvas.width - 70, 149);

//border

ctx.fillStyle = 'gainsboro';
drawLine(ctx, 800, 0, 800, canvas.height, 'green');


//farm alt

ctx.stroke();



ctx.fillStyle = 'gainsboro';
ctx.fillRect(0, 0, 50, canvas.height);


ctx.fillStyle = 'black';

ctx.lineWidth = 1;



ctx.fillText('2,500', 5, 12);
drawLine(ctx, 0, 10, canvas.width, 10, 'gainsboro');

ctx.fillText('2,000', 5, 60);
drawLine(ctx, 0, 60, canvas.width, 60, 'gainsboro');

ctx.fillText('1,500', 5, 110);
drawLine(ctx, 0, 110, canvas.width, 110, 'gainsboro');

ctx.fillText('1,000', 5, 160);
drawLine(ctx, 0, 160, canvas.width, 160, 'gainsboro');

ctx.fillText('500', 5, 210);
drawLine(ctx, 0, 210, canvas.width, 210, 'gainsboro');

ctx.fillText('0', 5, 260);
drawLine(ctx, 0, 260, canvas.width, 260, 'gainsboro');


//

let bar_width = 30;
let space_btn_crops = 100;
let start_x = 60;
let space_x_text = 32;
let max_text_width = 260;
let variety_text_width = 100;


//


drawCrop(ctx, start_x, 70, 100, 'green', 'H-124', 800, 1800)

drawCrop(ctx, start_x, 70, 50, 'red', 'H-164', 1400, 1800)

drawCrop(ctx, start_x, 170, 50, 'red', 'H-154', 200, 700)

function drawCrop(ctx, x, y, height, color, variety, min, max) {
    ctx.save();
    ctx.fillStyle = color;
    ctx.strokeStyle = color;
    ctx.strokeRect(x, y, bar_width, height);
    ctx.restore();


    ctx.font = '10px serif';
    ctx.fillStyle = 'red';
    ctx.fillText(max, start_x + space_x_text, y + 5, max_text_width);

    ctx.fillStyle = 'red';
    ctx.fillText(min, start_x + space_x_text, y + height, max_text_width);

    ctx.fillStyle = 'black';
    ctx.fillText(variety, start_x + space_x_text, height / 2 + y, max_text_width);

    start_x = start_x + space_btn_crops;




}


function drawText(ctx, x, y, width, height, color, variety, min, max) {
    ctx.fillStyle = color;
    ctx.fillText(' 1,800', 80, 75, 260);
}


// one bar
//   drawRect(ctx,60,70,20,60,'orangered');

//ctx.fillText(' 1,800', 80,75, 260);
// ctx.fillStyle = 'red';
//   ctx.fillText(' H-154', 80,110, 260);

//   ctx.fillStyle = 'black';
//  ctx.fillText(' 800', 80,138, 260);




// one bar
//  ctx.strokeStyle = 'green'; 
// drawRect(ctx,250,70,20,160,'lightgreen');

// //ctx.fillText(' 1,800', 250,75, 260);
//                ctx.fillStyle = 'red';
//                ctx.fillText(' H-162', 270,110, 260);






// function drawCrop(ctx, x, y, width, height, color,variety,min,max) {
//                     ctx.save();
//                     ctx.fillStyle = color;
//                     ctx.strokeRect(x, y, width, height);
//                     ctx.restore();
//                 }



function drawLine(ctx, startX, startY, endX, endY, color) {
    ctx.save();
    ctx.strokeStyle = color;
    ctx.beginPath();
    ctx.moveTo(startX, startY);
    ctx.lineTo(endX, endY);
    ctx.stroke();
    ctx.restore();
}


function drawRect(ctx, x, y, width, height, color) {
    ctx.save();
    ctx.fillStyle = color;
    ctx.strokeRect(x, y, width, height);
    ctx.restore();
}
</script>

var dom=document.getElementById('clock');
var ctx=dom.getContext('2d');
var width=ctx.canvas.width;
var height=ctx.canvas.height;
var r=width/2;
var bili=width/200;

function drawBackground(){
  ctx.save();
  ctx.translate(r,r);
  ctx.beginPath();
  ctx.lineWidth=10*bili;
  ctx.arc(0,0,r-ctx.lineWidth/2,0,2*Math.PI,false);
  ctx.stroke();
  
  var hourNumbers=[3,4,5,6,7,8,9,10,11,12,1,2];
    ctx.font=18*bili+"px Arial";
  	ctx.textAlign="center";
    ctx.textBaseline="middle";
  hourNumbers.forEach(function(number,i){
    var rad=2*Math.PI/12*i;
    var x=Math.cos(rad)*(r-28*bili);
    var y=Math.sin(rad)*(r-28*bili);
    ctx.fillText(number,x,y);
  });
  
  for(var i=0;i<60;i++){
	var rad=2*Math.PI/60*i;
    var x=Math.cos(rad)*(r-15*bili);
    var y=Math.sin(rad)*(r-15*bili);
    ctx.beginPath();
    if(i%5===0){
      ctx.fillStyle="red";
      ctx.arc(x,y,2*bili,0,2*Math.PI,0,false);
    }else{    
      ctx.fillStyle="black";
      ctx.arc(x,y,2*bili,0,2*Math.PI,0,false);
	}
    ctx.fill();
  }
}

function drawHour(hour,minute){
  ctx.save();
  ctx.beginPath();
  var rad=2*Math.PI/12*hour;
  var mrad=2*Math.PI/12/60*minute;
  ctx.rotate(rad+mrad);
  ctx.moveTo(0,10);
  ctx.lineTo(0,-r/2);
  ctx.lineCap="round";
  ctx.lineWidth=6*bili;
  ctx.stroke();
  ctx.restore();
}

function drawMinute(minute){
  ctx.save();
  ctx.beginPath();
  var rad=2*Math.PI/60*minute;
  ctx.rotate(rad);
  ctx.moveTo(0,10*bili);
  ctx.lineTo(0,-r+28*bili);
  ctx.lineCap="round";
  ctx.lineWidth=3*bili;
  ctx.stroke();
  ctx.restore();
}

function drawSecond(second){
  ctx.save();
  ctx.beginPath();
  var rad=2*Math.PI/60*second;
  ctx.rotate(rad);
  ctx.moveTo(-2,17*bili);
  ctx.lineTo(2,17*bili);
  ctx.lineTo(1,-r+17*bili);
  ctx.lineTo(-1,-r+17*bili);
  ctx.fillStyle="red";
  ctx.fill();
  ctx.restore();
}

function drawDot(){
  ctx.beginPath();
  ctx.arc(0,0,3,0,2*Math.PI,false);
  ctx.fillStyle="white";
  ctx.fill();
}

function draw(){
  ctx.clearRect(0,0,width,height);
  var n=new Date();
  var hour=n.getHours();
  var minute=n.getMinutes();
  var second=n.getSeconds();
  drawBackground();
  drawHour(hour,minute);
  drawMinute(minute);
  drawSecond(second);
  drawDot();
  ctx.restore();
}
draw();
setInterval(draw,1000);
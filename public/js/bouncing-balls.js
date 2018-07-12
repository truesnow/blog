var para = document.querySelector('p');
var count = 0;
// setup canvas

var canvas = document.querySelector('canvas');
var ctx = canvas.getContext('2d');

var width = canvas.width = window.innerWidth;
var height = canvas.height = window.innerHeight;

// function to generate random number

function random(min,max) {
  var num = Math.floor(Math.random()*(max-min)) + min;
  return num;
}

function Shape(x, y, velX, velY, exists) {
  this.x = x;
  this.y = y;
  this.velX = velX;
  this.velY = velY;
  this.exists = exists;
}

function Ball(x, y, velX, velY, exists, color, size) {
  Shape.call(this, x, y, velX, velY, exists);

  this.color = color;
  this.size = size;
}

// 创建一个新的和Shpae的原型属性值作为 `Ball.prototype` 的属性值。Ball 将拥有和 Shape 一样的属性值。
Ball.prototype = Object.create(Shape.prototype);
// 现在Teacher()的prototype的constructor属性指向的是Person(), 这是因为我们生成Teacher()的方式决定的。
// 正确设置 Ball 的原型
Ball.prototype.constructor = Ball;

Ball.prototype.draw = function() {
  ctx.beginPath();
  ctx.fillStyle = this.color;
  ctx.arc(this.x, this.y, this.size, 0, 2 * Math.PI);
  ctx.fill();
}

Ball.prototype.update = function() {
  if ((this.x + this.size) >= width) {
    this.velX = -(this.velX);
  }

  if ((this.x - this.size) <= 0) {
    this.velX = -(this.velX);
  }

  if ((this.y + this.size) >= height) {
    this.velY = -(this.velY);
  }

  if ((this.y - this.size) <= 0) {
    this.velY = -(this.velY);
  }

  this.x += this.velX;
  this.y += this.velY;
}

Ball.prototype.collisionDetect = function() {
  for (var j = 0; j < balls.length; j++) {
    if (!(this === balls[j])) {
      var dx = this.x - balls[j].x;
      var dy = this.y - balls[j].y;
      var distance = Math.sqrt(dx * dx + dy * dy);

      if (distance < this.size + balls[j].size) {
        balls[j].color = this.color = 'rgb(' + random(0, 255) + ',' + random(0, 255) + ',' + random(0, 255) +')';
      }
    }
  }
}

// 恶魔圈继承自 Shape
function EvilCircle(x, y, exists) {
  Shape.call(this, x, y, exists);

  this.color = 'white';
  this.size = 10;
  this.velX = 20;
  this.velY = 20;
}

// 设置恶魔圈原型
EvilCircle.prototype = Object.create(Shape);
EvilCircle.constructor = EvilCircle;

// 恶魔圈是空心圆
EvilCircle.prototype.draw = function() {
  ctx.beginPath();
  ctx.lineWidth = 3;
  ctx.strokeStyle = this.color;// 空心圆
  ctx.arc(this.x, this.y, this.size, 0, 2 * Math.PI);
  ctx.stroke();
}

// 不让恶魔圈出现在屏幕的边缘
EvilCircle.prototype.checkBounds = function() {
  if ((this.x + this.size) >= width) {
    this.x -= this.size;
  }

  if ((this.x - this.size) <= 0) {
    this.x += this.size;
  }

  if ((this.y + this.size) >= height) {
    this.x -= this.size;
  }

  if ((this.y - this.size) <= 0) {
    this.x += this.size;
  }
}

// 键盘左右移动恶魔圈
EvilCircle.prototype.setControls = function() {
  var _this = this;
  window.onkeydown = function(e) {
      if (e.keyCode === 65) {
        _this.x -= _this.velX;
      } else if (e.keyCode === 68) {
        _this.x += _this.velX;
      } else if (e.keyCode === 87) {
        _this.y -= _this.velY;
      } else if (e.keyCode === 83) {
        _this.y += _this.velY;
      }
    }
}

// 恶魔圈碰撞检测
EvilCircle.prototype.collisionDetect = function() {
  for (var j = 0; j < balls.length; j++) {
    // 检查小球是否存在，不存在即被恶魔圈吃掉了
    if (balls[j].exists) {
      var dx = this.x - balls[j].x;
      var dy = this.y - balls[j].y;
      var distance = Math.sqrt(dx * dx + dy * dy);

      if (distance < this.size + balls[j].size) {
        // 检测到碰撞吃掉小球
        balls[j].exists = false;
        count--;
        para.textContent = 'Ball count: ' + count;
      }
    }
  }
}

var balls = [];

// 创建恶魔圈
var evil = new EvilCircle(random(0, width), random(0, height), true);
evil.setControls();

function loop() {
  ctx.fillStyle = 'rgba(0, 0, 0, 0.25)';
  ctx.fillRect(0, 0, width, height);

  while (balls.length < 25) {
    var ball = new Ball(
      random(0,width),
      random(0,height),
      random(-7,7),
      random(-7,7),
      true,
      'rgb(' + random(0,255) + ',' + random(0,255) + ',' + random(0,255) +')',
      random(10,20),
    );
    balls.push(ball);
    count++;
    para.textContent = 'Ball count: ' + count;
  }

  for (var i = 0; i < balls.length; i++) {
    if (balls[i].exists) {
      // 小球存在时调用
      balls[i].draw();
      balls[i].update();
      balls[i].collisionDetect();
    }
  }

  evil.draw();
  evil.checkBounds();
  evil.collisionDetect();

  requestAnimationFrame(loop);
}

loop();
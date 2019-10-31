//[Create game objects]--------------------------------------------------------
function createAsteroid(x,y,size){
	var asteroid = {
		x:x, 
		y:y,
		xdir:-5,
		//randomize the y direction either up or down
		ydir:-2 + getRandomInt(0,4),
		size:size,
	};
	asteroids.push(asteroid);
	console.log("Asteroid - Created");
}

var Laser = function(){
	this.x = ship_x-5;
	this.y = ship_y+30;
	this.xdir = +5;
	this.ydir = 0;
};

Laser.prototype.setXY = function (x,y){
	this.x = x;
	this.y = y;
};

Laser.prototype.getX = function (x,y){
	return this.x;
};

Laser.prototype.getY = function (x,y){
	return this.y;
};

Laser.prototype.move = function (){
	this.x = this.x + this.xdir * laserSpeed;
};

function createLaser(){
	lasers.push(new Laser(this.x,this.y,this.xdir,this.ydir));
	lasersFired++;
	console.log("Laser - Created");
}

function createPickup(){
	var pickup = {
		// randomize everything :)
		x:getRandomInt(50,width-50), 
		y:getRandomInt(50,height-50),
		type:getRandomInt(1,3),
	};
	pickups.push(pickup);
	console.log("Pickup - Created");
}
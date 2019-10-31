//[Draw game objects]----------------------------------------------------------

function drawShip() {
	// rightkey is the key set in keyboard.js that moves the player right when pressed
	if (rightKey){
		ship_x += ship_speed;
		console.log("Player - Right");
	}
	// leftkey is the key set in keyboard.js that moves the player left when pressed
	else if (leftKey){
		ship_x -= ship_speed;
		console.log("Player - Left");
	}
	// upkey is the key set in keyboard.js that moves the player up when pressed
	else if (upKey){
		ship_y -= ship_speed;
		console.log("Player - Up");
	}
	// downkey is the key set in keyboard.js that moves the player down when pressed
	else if (downKey){
		ship_y += ship_speed;
		console.log("Player - Down");
	}
	// if the ship collides with the left wall, stop the player moving
	if (ship_x <= 0){
		ship_x = 0;
		console.log("Collided - left wall");
	}
	// if the ship collides with the right wall, stop the player moving
	if ((ship_x + ship_w) >= width){
		ship_x = width - ship_w;
		console.log("Collided - right wall");
	}
	// if the ship collides with the top wall, stop the player moving
	if (ship_y <= 0){
		ship_y = 0;
		console.log("Collided - top wall");
	}
	// if the ship collides with the bottom wall, stop the player moving
	if ((ship_y + ship_h) >= height){
		ship_y = height - ship_h;
		console.log("Collided - bottom wall");
	}  
	// draw the ship
	ctx.drawImage(ship, ship_x, ship_y);

}

function drawAsteriods() {
	// get the array of asteroids
	for(var i=0; i<asteroids.length; i++){
		var asteroid = asteroids[i];
		// draw the array objects to the screen
		ctx.drawImage(astimg, asteroid.x, asteroid.y, asteroid.size, asteroid.size);
	}
}

function drawPickups() {
	// get array of pickups
	for(var i=0; i<pickups.length; i++){
		var pickup = pickups[i];
		// if the type is 1, set it to be a sheild pickup
		if(pickup.type == 1){
			ctx.drawImage(sheildimg, pickup.x, pickup.y, 30, 30);
		}
		// if the type is 2, set it to be a health pickup
		else if((pickup.type == 2)){
			ctx.drawImage(healthimg, pickup.x, pickup.y, 30, 30);
		}
		// if the type is 3, set the powerup to unlock autofiring
		else {
			ctx.drawImage(autofireimg, pickup.x, pickup.y, 30, 30);
		}
	}
}

function drawLaser() {
	// get array of lasers
    for(var i=0; i<lasers.length; i++) {
		var laser = lasers[i];
		// draw lasers to the screen
		ctx.drawImage(laserimg, laser.getX(), laser.getY(), 20, 5);
		// if the lasers x pos. is the edge of the screen, remove it from the array
		if((laser.getX() + 20) >= width){
			lasers.splice(i,1);
		console.log("Laser - Removed");
		}
	}
}

function drawBars() {
	// set a custom font
	ctx.font = 'bold 18px VT323';
	// set colour to white for visibility
	ctx.fillStyle = '#fff';
	ctx.fillText('SHEILD', width-300, height-50);
	ctx.fillText('HEALTH', width-300, height-30);
	// if the players health is below 30, display a large warning
	if(health < 30){
		ctx.font = 'bold 48px VT323';
		// set colour to red
		ctx.fillStyle = '#f00';
		ctx.fillText('[LOW HEALTH WARNING]', width/2-200, 60);
	}
	// draw the sheild bar with the current sheid value
	ctx.fillStyle = "blue";
	ctx.fillRect(width-230,height-60,sheild*2,10);
	// draw the health bar with the current health value
	ctx.fillStyle = "green";
	ctx.fillRect(width-230,height-40,health*2,10);
}
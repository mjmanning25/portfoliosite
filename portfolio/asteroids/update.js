//[Update object positions]----------------------------------------------------
function updateAsteroids(){
	// get array of asteroids
	for(var i=0; i<asteroids.length; i++){
		var asteroid = asteroids[i];
		// update x and y positions
		asteroid.x = asteroid.x + asteroid.xdir * asteroidSpeed;
		asteroid.y = asteroid.y + asteroid.ydir * asteroidSpeed;
	}
	
	if(getTimeNow() > timeForNextAst){
		// create an atseroid when the timer equals zero
		createAsteroid(width,getRandomInt(0,height),80);
		timeForNextAst = getTimeNow() + timeBetweenAsts;
	}else{
		// if the timer does not equal zero, decrease the timer
		timeBetweenAsts--;
		// this sets the minimum value of the spawn rate so the game does not become unbeatable
		if (timeBetweenAsts <= minTimeBetweenAsts){
			timeBetweenAsts = 500;
		}
	}
}

function updateLasers(){
	// get array of lasers
	for(var i=0; i<lasers.length; i++){
		var laser = lasers[i];
		// update lasers positions
		laser.move();
	}
}

function updateAccuracy(){
	// this is updated constantly to determine the players accuracy and is parsed into the score when the game ends
	accuracy = Math.round(asteroidsHit / lasersFired*100);
}

function updateFinalScore(){
	// due to logic errors I had to make this variable into a function to allow it to update correclty
	finalScore = score * points_multiplier * accuracy;
}

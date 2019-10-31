//[Collision detection for asteroids and lasers]-------------------------------

function collisionDetection(){
	// get asteroid array
	for(var i=0; i<asteroids.length; i++){
		var asteroid = asteroids[i];
		// get lasers array
		for(var j=0; j<lasers.length; j++){
			var laser = lasers[j];
			// if laser and astroid collide when the size is 80 (large asteroid) remove the laser and asteroid
			// and create 3 smaller asteroids at the x/y of the previously shot asteroid
			// add 1 to the hit counter
			if (hypot(laser.getX() - asteroid.x, laser.getY() - asteroid.y)< asteroid.size && asteroid.size == 80){
				lasers.splice(j, 1);
				asteroids.splice(i,1);
				createAsteroid(asteroid.x, asteroid.y,40);
                createAsteroid(asteroid.x, asteroid.y,40);
                createAsteroid(asteroid.x, asteroid.y,40);
				console.log("Asteroid - Split");
				asteroidsHit++;
			}
			// if laser and astroid collide when the size is 40 (medium asteroid) remove the laser and asteroid
			// and create 2 smaller asteroids at the x/y of the previously shot asteroid
			// add 1 to the hit counter
			if (hypot(laser.getX() - asteroid.x, laser.getY() - asteroid.y)< asteroid.size && asteroid.size == 40){
				lasers.splice(j, 1);
				asteroids.splice(i,1);
				createAsteroid(asteroid.x, asteroid.y,20);
				createAsteroid(asteroid.x, asteroid.y,20);
				console.log("Asteroid - Split");
				asteroidsHit++;
			}
			// if laser and astroid collide when the size is 20 (small asteroid) remove the laser and asteroid
			// and add 10 to the players score then multiply it by the points multiplier
			// add 1 to the hit counter
			if (hypot(laser.getX() - asteroid.x, laser.getY() - asteroid.y)< asteroid.size && asteroid.size == 20){
				lasers.splice(j, 1);
				asteroids.splice(i,1);
				score = score + 10 * points_multiplier;
				asteroidsHit++;
			}
		}
	}
}

//-------------------------------------
function playerCollision(){
	// get asteroid array
	for(var i=0; i<asteroids.length; i++){
		var asteroid = asteroids[i];
		// if player hits asteroid remove sheild
		if (hypot(ship_x/2 - asteroid.x/2, ship_y/2 - asteroid.y/2) < asteroid.size/2){
			//if there is a sheild and you get hit, remove sheild
			if(sheild > 0){
				// remove sheild amount (*/100) based on asteroid size
				sheild = sheild-asteroid.size;
				// remove asteroid
				asteroids.splice(i,1);
				// to make the game easier, if the player has 1 sheild and the asteroid hits dealing 30 damage, only remove the 1 sheild
				if (sheild < 0){
				sheild = 0;
				}
			// if there is no sheild left, remove health instead
			}else if(sheild <= 0 && health > 0){
				health = health-asteroid.size;
				asteroids.splice(i,1);
				// same as before, this is used to make the game easier
				if (health < 0){
				health = 0;
				}
			// if the player has 0 health, end the game
			}else if(health <= 0){
				// change the game state, this stops everything from updating in game
				alive=false;
				// display the game over screen
				gameoverscreen();
				console.log("Asteroid - Player");
				// remove the asteroid that killed the player
				asteroids.splice(i,1);
			}
		}
	}
}

//-------------------------------------
function pickupCollision(){
	// get pickups array
	for(var i=0; i<pickups.length; i++){
		var pickup = pickups[i];
		//if player touches the pickup and type = sheild, max the sheild and remove the pickup
		if (hypot(ship_x/2 - pickup.x/2, ship_y/2 - pickup.y/2) < 30 && pickup.type == 1){
			pickups.splice(i,1);
			sheild = 100;
		//if player touches the pickup and type = health, max the health and remove the pickup
		}else if (hypot(ship_x/2 - pickup.x/2, ship_y/2 - pickup.y/2) < 30 && pickup.type == 2){
			pickups.splice(i,1);
			health = 100;
		//if player touches the pickup and type = laser, unlock the autofire ability and remove the pickup
		}else if (hypot(ship_x/2 - pickup.x/2, ship_y/2 - pickup.y/2) < 30 && pickup.type == 3){
			pickups.splice(i,1);
			autofireUnlocked = true;
		}
		// if the auto fire is unlocked, randomize the pickup to either health or sheild
		if(pickup.type == 3 && autofireUnlocked == true){
			pickup.type = getRandomInt(1,2);
		}
		// get lasers array
		for(var j=0; j<lasers.length; j++){
			var laser = lasers[j];
			// if the laser collides with a pickup, remove them both (for difficulty)
			if(hypot(laser.getX() - pickup.x, laser.getY - pickup.y) < 30){
				pickups.splice(i,1);
			}
		}
	}
}
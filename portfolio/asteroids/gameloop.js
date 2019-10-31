function gameLoop() {
	// clear the screen every time the function is called by init
	clearCanvas();
	// if the player is alive, update everything
	if (alive){
		//update the asteroid / player collisions
		collisionDetection();
		//update the player / walls collisions
		playerCollision();
		//update the player & laser / pickup collisions
		pickupCollision();
		//update the asteroid positions
		updateAsteroids();
		//update the laser positions
		updateLasers();
		//draw the pickups to the screen
		drawPickups();
		//draw the asteroids to the screen
		drawAsteriods();
		//draw the lasers to the screen
		drawLaser();
		//draw the player to the screen
		drawShip();
		//draw the health and sheild bars to the screen
	    drawBars();
	    //draw the score to the screen
		showScore();
		// update the players accuracy
		updateAccuracy();
		// update the final score when the game ends
		updateFinalScore();
		if(score >= 100){
			points_multiplier = 2;
		}if(score >= 500){
			points_multiplier = 3;
		}if(score >= 1000){
			points_multiplier = 4;
		}if(score >= 5000){
			points_multiplier = 5;
		}if(score >= 10000){
			points_multiplier = 6;
		}if(score >= 50000){
			points_multiplier = 7;
		}if(score >= 100000){
			points_multiplier = 8;
		}if(score >= 500000){
			points_multiplier = 9;
			createPickup();
		}if(score >= 1000000){
			points_multiplier = 10;
		}if(autofire === true && lasers.length <= laserTotal){
			createLaser();
		}
		if(getTimeNow() > timeForNextPickup && pickups.length < maxPickups){
			createPickup();
			timeForNextPickup = getTimeNow() + timeBetweenPickups;
		}
	}
	else if (pause){
		pausegame();
	}
	else if (gameover){
		gameoverscreen();
	}
	else if (menu){
		menuscreen();
	}
	else if (options){
		optionsscreen();
	}
	else if (endScore){
		endScorescreen();
	}
}

function restart(){
	timeBetweenAsts = 2000;
	minTimeBetweenAsts = 500;
	timeForNextAst= 0;
    lasers.length = 0;
	asteroids.length = 0;
	pickups.length = 0;
	points_multiplier = 1;
	asteroidsHit = 0;
	lasersFired = 0;
	sheild = 100;
	health = 100;
    rightKey = false;
    leftKey = false;
    upKey = false;
    downKey = false;
	ship_x = (width / 2) - 25;
	ship_y = (height/2) - 80;
	alive = true;
	pause = false;
	gameover = false;
	menu = false;
	endScore = false;
	options = false;
	autofire = false;
	autofireUnlocked = false;
	score = 0;
	console.log("########## RESET ##########");
}
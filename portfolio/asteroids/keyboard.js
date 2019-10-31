//[Keyboard listeners]---------------------------------------------------------

// this is where 90% of the games logic is held
// there are two key listeners used in my code, one for when the key is pressed
// and one for when the key is released. the keyDown listener is used the most
// and is used mainly for the menu systems of the game to allow transitions between
// game states and player movement as well as shooting.

function keyDown(e) {
	// this is the player movement (WASD)
	if (e.keyCode == 68) rightKey = true;
	else if (e.keyCode == 65) leftKey = true;
	else if (e.keyCode == 87) upKey = true;
	else if (e.keyCode == 83) downKey = true;
	//fire lasers if you have some ammo (SPACE)
	if (e.keyCode == 32 && lasers.length <= laserTotal){
		createLaser();
	}
	//pause menu
	// if the player presses "p" and the game ISNT paused, pause it
	// if the player presses "p" and the game IS paused, un pause it
	// this is a basic toggle used in my code and will be repeated
	if (e.keyCode == 80 && pause === false){
		// all game states are used in the toggle to allow the player to pause during an game state
		alive = false;
		pause = true;
		gameover = false;
		menu = false;
		endScore = false;
		options = false;
	}else if (e.keyCode == 80 && pause === true){
		// this is a logic error
		// if the player constantly un-pauses and pauses the game they are able to continue after death
		// and keep playing, basically cheating...
		alive = true;
		pause = false;
		gameover = false;
		menu = false;
		endScore = false;
		options = false;
	}
	//resart game when "r" is pressed
	else if (e.keyCode == 82) restart();
	//goto menu when "m" is pressed
	else if (e.keyCode == 77){
		menuscreen();
		// again all variables are used so you can change the state at any point in the game
		alive = false;
		pause = false;
		gameover = false;
		menu = true;
		endScore = false;
		options = false;
	}
	//gameover continue button
	// when the game over is displayed and the player presses "enter" button, move to the next state
	else if (e.keyCode == 13 && gameover === true){ 
		alive = false;
		pause = false;
		gameover = false;
		menu = false;
		endScore = true;
		options = false;
	}
	//score continue button
	// same as the game over continue, this allow the player to move to the next state
	else if (e.keyCode == 13 && endScore === true){
		alive = false;
		pause = false;
		gameover = false;
		menu = true;
		endScore = false;
		options = false;
	}
	//menu continue button
	// when the player presses "enter" at the menu
	// start the game
	else if (e.keyCode == 13 && menu === true){
		restart();
	}
	//options menu button
	// this is a toggle like the pause menu that activates whe nthe player presse "o"
	else if (e.keyCode == 79 && options === false){
		alive = false;
		pause = false;
		gameover = false;
		menu = false;
		endScore = false;
		options = true;
	// toggle back and go to the menu
	}else if (e.keyCode == 79 && options === true){
		alive = false;
		pause = false;
		gameover = false;
		menu = true;
		endScore = false;
		options = false;
	}
	//options in options menu
    //------------------------------------------------------------------------------------------------
	// if the player is in the options menu and presses "1", open an input box to change the variable
	// of the asteroid spawn rate min and max
	else if (e.keyCode == 49 && options === true){
		//Asteroid spawn rate Max
		// display the input popup
		timeBetweenAstsEdit = window.prompt("Enter Max Asteroid Spawn Rate(Milliseconds):","2000");
		// if the input is greater than the max, set it to the max
		if(timeBetweenAstsEdit >= 10000){
			timeBetweenAstsEdit = 10000;
			    // use the buffer variables to check if the input is valid
            	timeBetweenAst = parseInt(timeBetweenAstsEdit);
		
		// if the input is less than the minimum, set it to the minimum
		}else if(timeBetweenAstsEdit <= 250){
			timeBetweenAstsEdit = 250;
			    // use the buffer variable to check if new input is valid
            	timeBetweenAst = parseInt(timeBetweenAstsEdit);		
        	}else{
        	    // if everything entered is valid, update the variables
            	timeBetweenAst = parseInt(timeBetweenAstsEdit);
        	}
		
		//Asteroid spawn rate Min
		// this is used to stoip the game getting infinitley harder over time but the player can change this
		minTimeBetweenAstsEdit = window.prompt("Enter Min Asteroid Spawn Rate(Milliseconds):","250");
		minTimeBetweenAsts = parseInt(minTimeBetweenAstsEdit);
    //------------------------------------------------------------------------------------------------	
    // option 2
    // if the player presse "2", display a popup  to set that asteroid speed
	}else if (e.keyCode == 50 && options === true){
		//Asteroid Speed
		asteroidSpeedEdit = window.prompt("Enter Asteroid Speed(1-5):","1");
		// if the asteroid speed is greater than the max speed, set it to the max speed
		if(asteroidSpeedEdit >= 5){
			asteroidSpeedEdit = 5;
			// parse the updated speed to the game
			asteroidSpeed = parseInt(asteroidSpeedEdit);
		// if the input is less than the min, set it to the min
		}else if(asteroidSpeedEdit <= 1){
			asteroidSpeedEdit = 1;
			// parse the new variables
			asteroidSpeed = parseInt(asteroidSpeedEdit);
		}else{
		    // otherwise just update the variable with the new input
			asteroidSpeed = parseInt(asteroidSpeedEdit);
		}
    //------------------------------------------------------------------------------------------------
	
	//option 3
	// if the player presses "3", open an input box
	}else if (e.keyCode == 51 && options === true){
		//Laser Amount
		// this is used for difficulty, this sets the maxmimum amount of lasers that the player can shoot at any time
		laserTotalEdit = window.prompt("Enter the amount of max lasers on the screen(6-20):","6");
		// if the input is grayer than the max, set it to the max
		if(laserTotalEdit >= 20){
			laserTotalEdit = 20;
			// update the variables
			laserTotal = parseInt(laserTotalEdit);
		// if the input is smaller than the min, set it to the min
		}else if(laserTotalEdit <= 6){
			laserTotalEdit = 6;
			// update the variables
			laserTotal = parseInt(laserTotalEdit);
		}else{
		    // if everything is corerect, update the variables
			laserTotal = parseInt(laserTotalEdit);
		}
	}
	//------------------------------------------------------------------------------------------------
	
	//autofire
	// this is another toggle used for whne the player presses "z" and they have unlocked the powerup
	// if they try to use this without the powerup unlocked it wil not run
	else if (e.keyCode == 90 && autofireUnlocked === true && autofire === false){
		autofire = true;
	}else if (e.keyCode == 90 && autofire === true){
		autofire = false;
	}

}

// this is the seccond key listener, used to stop the player moving when the key is released
function keyUp(e) {
	if (e.keyCode == 68) rightKey = false;
	else if (e.keyCode == 65) leftKey = false;
	else if (e.keyCode == 87) upKey = false;
	else if (e.keyCode == 83) downKey = false;
}
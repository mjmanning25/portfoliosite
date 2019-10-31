//[Score, Highscore, Pause, Gameover, Menu, options]---------------------------

// this function is called constantly to display the current variables
function showScore() {
	// set custom font
	ctx.font = 'bold 18px VT323';
	// set color to white for visibility
	ctx.fillStyle = '#fff';
	// display variables
	ctx.fillText('Score: ' + score, 20, 30);
	ctx.fillText('Highscore: ' + highscore + ' - ' + name, 20, 50);
	ctx.fillText('Lasers Used: ' + lasers.length + ' / ' + laserTotal, 20, height - 30);
	ctx.fillText('Accuracy: ' + accuracy + ' % ' , 20, height - 60);
	// only show this if pickup has been activated
	if(autofireUnlocked === true){
		ctx.fillText('Auto Fire: ' + autofire, 20, height - 90);
	}
}

// this screen is displayed after the game over screen
function endScorescreen(){
    // set custom font
	ctx.font = 'bold 48px VT323';
	// set color to white
	ctx.fillStyle = '#fff';
	// display vairables
	ctx.fillText('Score: '+finalScore, width/2-100, height/2-50);
	ctx.font = 'bold 32px VT323';
	ctx.fillText('Highscore: '+highscore, width/2-100, height/2+50);
	ctx.fillText('Best Player: '+name, width/2-100, height/2+100);
	// asks player to enter their name if they get a highscore
	if (finalScore > highscore){
		// updates the players name
		name = window.prompt("Enter your name:","Player 1");
		// updates the highscore
		highscore = finalScore;
	}
	console.log("########## SCORES ##########");
}

// when this function is called set the state to gameover
function gameoverscreen(){
	gameover = true;
	ctx.font = 'bold 200px VT323';
	// increase the Red value for the game over text to add a pulsating effect
	if(increase === true){
		r+=5;
		// when the red value gets to 255 (the maximum) then start decreasing it
		if(r >= 255){
			increase = false;
			decrease = true;
		}
	}
	// decrease the red value to 0 slowly
	else if(decrease === true){
		r-=5;
		// when it reaches 0, make red increase
		if(r <= 0){
			increase = true;
			decrease = false;
		}
	}
	// colour the text with the custom value for red
	ctx.fillStyle = 'rgb('+r+',0,0)';
	ctx.fillText('GAME OVER', width/2-400, height/2-50);
	ctx.font = 'bold 20px VT323';
	ctx.fillText('Press "ENTER" to continue', width/2-105, height/2+50);
	console.log("########## GAME OVER ##########");
}

// display "paused" when the game state is set to pause
function pausegame(){
	ctx.font = 'bold 48px VT323';
	ctx.fillStyle = '#fff';
	ctx.fillText('PAUSED', width/2-50, height/2-50);
	ctx.font = 'bold 12px VT323';
	ctx.fillText('Press "p" to continue', width/2-40, height/2+50);
	console.log("########## PAUSE ##########");
}

// this is the main screen for the game, it is displayed when the game is first started
function menuscreen(){
    // randomly set the font colour to any value (updated constantly) (bad if people have epilepsy)
	ctx.fillStyle = 'rgb('+getRandomInt(0,255)+','+getRandomInt(0,255)+','+getRandomInt(0,255)+')';
	// set custom font
	ctx.font = 'bold 100px VT323';
    ctx.fillText('Asteroids Game', width / 2 - 300, height / 2-150);
    ctx.font = 'bold 20px VT323';
    //set font colour to white
    ctx.fillStyle = '#fff';
	ctx.fillText('By Michael Manning', width / 2 + 145, height / 2-125);
	// draw the players ship for the coolness effect
	ctx.drawImage(ship, width/2-25, height/2-80);
	ctx.fillText('HIGHSCORE: '+highscore, width - 300, height - 60);
	ctx.fillText('SCORE HOLDER: '+name, width - 300, height - 40);
//-------------------------------------------------------------
	// draw the sheild pickup and explain what it does
	ctx.drawImage(sheildimg, 20, height-120, 30, 30);
	ctx.fillText('SHEILD PICKUP', 50, height-100);
	// draw the health pickup and explain what it does
	ctx.drawImage(healthimg, 20, height-90, 30, 30);
	ctx.fillText('HEALTH PICKUP', 50, height-70);
	// draw the autofire pickup and explain what it does / how to use it
	ctx.drawImage(autofireimg, 20, height-60, 30, 30);
	ctx.fillText('AUTO FIRE PICKUP (press "Z")', 50, height-40);
//--------------------------------------------------------------
	// display the game's controls
	ctx.font = 'bold 32px VT323';
	ctx.fillText('Press "ENTER" to play!', width / 2 - 160, height / 2 + 30);
    ctx.font = 'bold 14px VT323';
	ctx.fillText('Use "WSAD" keys to move', width / 2 - 100, height / 2 + 80);
    ctx.fillText('Use the "SPACE" key to shoot', width / 2 - 100, height / 2 + 110);
	ctx.fillText('Use the "P" key to pause', width / 2 - 100, height / 2 + 140);
	ctx.fillText('Use the "R" key to restart', width / 2 - 100, height / 2 + 170);
	ctx.fillText('Use the "O" key to change game setings', width / 2 - 100, height / 2 + 200);
	ctx.fillText('Use the "M" key to go to the menu', width / 2 - 100, height / 2 + 230);
	console.log("########## MENU ##########");
}

// displayed when the player opens the options menu
function optionsscreen(){
	// set custom font and colour
	ctx.font = 'bold 48px VT323';
	ctx.fillStyle = '#fff';
	ctx.fillText('OPTIONS', width/2-80, height/2-50);
	ctx.font = 'bold 12px VT323';
	// display the current options avaliable to the player
	ctx.fillText('[1] Asteroid Spawn Rate', width/2-65, height/2+50);
	ctx.fillText('[2] Asteroid Speed', width/2-65, height/2+100);
	ctx.fillText('[3] Laser Ammo Amount', width/2-65, height/2+150);
	console.log("########## OPTIONS ##########");
}
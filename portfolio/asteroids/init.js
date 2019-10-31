//[Start game and run game logic]----------------------------------------------

// this is a complete re-write of the teachers startit/startup function used
// to init everything major in the game, suck as key listeners and document elements
// I decided to re-write this section to make it more tidy and easier to understand
// and I ended up with this...

function init() {
	// define the canvas element
	canvas = document.getElementById('canvas');
	// set the canvas to be a 2d object
	ctx = canvas.getContext('2d');
	// call the function gameLoop every 25 milliseconds
	setInterval(gameLoop, 25);
	// add key listeners for keyup and keydown to allow keyboard input
	document.addEventListener('keydown', keyDown, false);
	document.addEventListener('keyup', keyUp, false);
}
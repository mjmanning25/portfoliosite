//[Misc. functions]------------------------------------------------------------
function getTimeNow(){
	// Mr. Godfrey's code
	return  +new Date();
}	

function getRandomInt(min, max){
	// Mr. Godfrey's code
	return Math.floor((Math.random() * max) + min); 
}
	
function clearCanvas() {
	// TL;DR this clears the screen of EVERYTHING every time the game updates.
	
	// I decided to write my own update game function different from the teacher
	// to allow for a nicer layout of code (mainly for the keyboard inputs) but 
	// also for the update game (gameloop) function. instead of using complicated
	// maths to work out the games fps updates using time, I call this function every
	// 25 milisecconds using a call in my init.js file to HTML and that allows for a
	// cleaner updating game. I have also found that clearRect also offers a performance
	// increase comparewd to drawing a black rectangle constantly and then drawing over
	// it.
	ctx.clearRect(0,0,width,height);
}

function hypot(xdiff,ydiff){
	// Mr. Godfrey's code
	return Math.sqrt((xdiff*xdiff)+(ydiff*ydiff));
}
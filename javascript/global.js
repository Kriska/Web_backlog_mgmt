function nothingInDb() {
	document.getElementById("noRowInDB").innerHTML = "Невалидно потребителското име и/или парола.";
}

function success(message) {
	var element = document.getElementById("created");
	unfade(element, message);
	fade(element);
}

function error(message) {
	var element = document.getElementById("error");
	unfade(element, message);
	fade(element);
}
function crossDoneTasks(done) {
	if(done == 1){
		var element = document.getElementById("link");
		element.style.textDecoration = "line-through";
	}
	return;
}

function unfade(element, message) {
    var op = 0.1;  // initial opacity
    element.style.display = 'block';
    var timer = setInterval(function () {
        if (op >= 1){
			return;
        }else {
		element.style.border = "solid thin white";
		element.innerHTML = message;
        element.style.opacity = op;
        element.style.filter = 'alpha(opacity=' + op * 100+ ")";
        op += op * 0.1;
		}
	}, 100);
	return;
}
function fade(element) {
    var op = 1;  // initial opacity
    var timer = setInterval(function () {
        if (op <= 0.1){
            element.style.display = 'none';
			return;
        }
        element.style.opacity = op;
        element.style.filter = 'alpha(opacity=' + op * 100 + ")";
        op -= op * 0.1;
    }, 100);
	return;
}
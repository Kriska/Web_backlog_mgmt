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

function validateForm() {
	var title = document.forms["createForm"]["title"].value;
	var desc = document.forms["createForm"]["desc"].value;
	var date = document.forms["createForm"]["date"].value;
	if(title === "" || desc === "" || date === ""){
		error("Попълнете всички полетата!");
		return false;
	}
	if(title > 20 || desc > 250){
		error("Данните не са валидни!");
		return false;
	}
	var t = date.match(/^(\d{4})-(\d{2})-(\d{2})$/);
	if(t === null){
		error("Датана е в неправилен формат");
		return false;
	}
	return true;
}

function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}


function drop(ev) {
    ev.preventDefault();
    var myData = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(myData));
}
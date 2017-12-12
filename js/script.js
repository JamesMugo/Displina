function signUp() {
	var name = document.getElementById('username').value;
	var email = document.getElementById('email').value;
	var password = document.getElementById('password').value;
	var org = document.getElementById('org').value;
	var phone = document.getElementById('phone').value;
	var age = document.getElementById('age').value;

	if (name==="" || email==="" || password === "" || org==="" || phone ==="" || age === "") {
		alert("Complete all fields");
	}
	else{
		var request = new XMLHttpRequest();
		request.onreadystatechange=function(){
			if (this.readyState==4 && this.status == 200) {
				if (this.responseText == "success") {
					window.location.assign("../pages/index.html");
				}
			}
		};
	}
	request.open("GET","../pages/database.php?name="+name+"&email="+email+"&password="+password+"&org="+org+"&phone="+phone+"&age="+age,true);
	request.send();

}

function userLogin() {
	var name = document.getElementById('username').value;
	var password = document.getElementById('password').value;

	if (name==="" || password === "") {
		alert("Complete all fields");
	}
	else{
		var request = new XMLHttpRequest();
		request.onreadystatechange=function(){
			if (this.readyState==4 && this.status == 200) {
				if (this.responseText == "login") {
					window.location.assign("../pages/dash.html");
				}
			}
		};
	}
	request.open("GET","../pages/database.php?name="+name+"&passwd="+password,true);
	request.send();

}

function postUploader(){
	var image = document.getElementById('image').value;

	if (image==="" ) {
		alert("Select an image please");
	}
	else{
		var request = new XMLHttpRequest();
		request.onreadystatechange=function(){
			if (this.readyState==4 && this.status == 200) {
				if (this.responseText == "uploaded") {
					//window.location.assign("../pages/dash.html");
					alert("Post uploaded");
				} else{
					alert("Can't upload image !");
				}
			}
		};
	}
	request.open("GET","../pages/database.php?image"+image,true);
	request.send();
}

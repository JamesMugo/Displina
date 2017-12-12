<?php

if (isset($_POST['register'])) {
	include 'database';

	$username = $_POST['username'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$age = $_POST['age'];
	$org = $_POST['org'];
	$pass = $_POST['password'];

	$sql = "INSERT INTO users (username, email, phone, age, organization, password) VALUES ($username, $email, $phone, $age, $org, $pass)";

	if (!mysqli_query($con, $sql)) {
		die('error registering new user');
	}

	$newrecord = "new user registered"; 
}





?>
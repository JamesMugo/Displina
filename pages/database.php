<?php

	$username = "";
    $email = "";
    $phone = "";
    $age = "";
    $org = "";
    $pass = "";

    $errors = array();

	$db = mysqli_connect("localhost", "root", "", "displina");

    if (!$db) {
        echo "Database connection failed";
    } else{
        echo "Database connection successful";
        if (isset($_POST['newuser'])) {

        $username = mysqli_real_escape_string($db, $_POST['username']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $phone = mysqli_real_escape_string($db, $_POST['phone']);
        $age = mysqli_real_escape_string($db, $_POST['age']);
        $org = mysqli_real_escape_string($db, $_POST['org']);
        $pass = mysqli_real_escape_string($db, $_POST['password']);

        if (empty($username)) {
            array_push($errors, "username is required");
        }
        if (empty($email)) {
            array_push($errors, "email is required");
        }
        if (empty($phone)) {
            array_push($errors, "phone is required");
        }
        if (empty($age)) {
            array_push($errors, "age is required");
        }
        if (empty($org)) {
            array_push($errors, "Organization is required");
        }
        if (empty($pass)) {
            array_push($errors, "password is required");
        }

        if (count($errors) == 0) {
            $password = md5($pass);
            $sql = "INSERT INTO users (username, email, phone, age, organization, password) VALUES ($username, $email, $phone, $age, $org, $password)";

            $exec = mysqli_query($db, $sql);

            if (!$exec) {
                echo "Error" . mysqli_error();
            }

            $_SESSION['username'] = $username;
            $_SESSION['success'] = "Your are now logged in to Displina";
            header('location: index.php');
            }
        }

    }



	//log user in from login page
	if (isset($_POST['login'])) {
    	$username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if (empty($username)) {
        	array_push($errors, "username is required");
        }
        if (empty($password)) {
        	array_push($errors, "password is required");
    	}

    	if (count($errors) == 0) {
    		$password = md5($password);
    		$qry = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    		$results = mysqli_query($db, $qry);
    		if (mysqli_num_rows($results) == 1) {
    			$_SESSION['username'] = $username;
    	    	$_SESSION['success'] = "Your are now logged in to Displina";
    	    	header('location: index.php');
    		}else{
    			array_push($errors, "wrong username/password combination");
    		}


    	}
    }

        //logout
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header('location: login.php');
    }


?>
<?php
session_start();
if (isset($_GET['age'])) {
    createUser();
}
elseif (isset($_GET['passwd'])) {
    login();
}
elseif (isset($_GET['titleBrief'])) {
    uploadPost();
}

function createUser()
{

    $db = mysqli_connect("localhost", "root", "", "displina");
    if (!$db) {
        echo "Database connection failed";
    } else{
        $username = mysqli_real_escape_string($db, $_GET['name']);
        $email = mysqli_real_escape_string($db, $_GET['email']);
        $phone = mysqli_real_escape_string($db, $_GET['phone']);
        $age = mysqli_real_escape_string($db, $_GET['age']);
        $org = mysqli_real_escape_string($db, $_GET['org']);
        $pass = mysqli_real_escape_string($db, $_GET['password']);

            $password = md5($pass);
            $sql = "INSERT INTO users (username, email, phone, age, organization, password) VALUES ('$username', '$email', '$phone', '$age', '$org', '$password')";

            $exec = mysqli_query($db, $sql);

            if (!$exec) {
                echo "Error" . mysqli_error($db);
            }
            else{
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "Your are now logged in to Displina";
                echo "success";
            }

    }
}


function login(){
	//log user in from login page

    $db = mysqli_connect("localhost", "root", "", "displina");
    if (!$db) {
        echo "Database connection failed";
    } else{
    	$username = mysqli_real_escape_string($db, $_GET['name']);
        $password = mysqli_real_escape_string($db, $_GET['passwd']);

    		$passwor = md5($password);
    		$qry = "SELECT * FROM users WHERE username='$username' AND password='$passwor'";
    		$results = mysqli_query($db, $qry);
    		if (mysqli_num_rows($results) == 1) {
    			$_SESSION['username'] = $username;
    	    	$_SESSION['success'] = "Your are now logged in to Displina";
    	    	echo "login";
    		}else{
    			echo "login failed ";
    		}
        }

    }

    function logout(){
                //logout
        if (isset($_GET['logout'])) {
            session_destroy();
            unset($_SESSION['username']);
            header('location: login.php');
            }
        }

function uploadPost()
{  

    $db = mysqli_connect("localhost", "root", "", "displina");

    $imageName = mysqli_real_escape_string($_FILES['image']['name']);
    $imageData = mysqli_real_escape_string(file_get_contents($_FILES['image']['tmp_name']));
    $imageType = mysqli_real_escape_string($_FILES['image']['type']);

    $sql = "INSERT INTO posts VALUES ('', '$imageName', '$imageData')"; 
    if (substr($imageType,0,5) == "image") {
        mysqli_query($db, $sql);
        echo "uploaded";
    }else{
        echo "Only images are allowed";
    }
}
?>
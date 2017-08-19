<?php
	// Here we are using sessions to propagate the login
	// http://us3.php.net/manual/en/intro.session.php

    // HTTPS redirect
    if ($_SERVER['HTTPS'] !== 'on') {
		$redirectURL = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		header("Location: $redirectURL");
		exit;
	}
	
	// http://us3.php.net/manual/en/function.session-start.php
	if(!session_start()) {
		// If the session couldn't start, present an error
		header("Location: error.php");
		exit;
	}
	
	
	// Check to see if the user has already logged in
	$loggedIn = empty($_SESSION['loggedin']) ? false : $_SESSION['loggedin'];
	
	if ($loggedIn) {
		header("Location: page1.php");
		exit;
	}
	
	
	$action = empty($_POST['action']) ? '' : $_POST['action'];
	
	if ($action == 'do_create') {
		createUser();
	} else {
		login_form();
	}
	
	function createUser() {
		$username = empty($_POST['userName']) ? '' : $_POST['userName'];
		$password = empty($_POST['password']) ? '' : $_POST['password'];
        
        $firstName = empty($_POST['firstName']) ? '' : $_POST['firstName'];
		$lastName = empty($_POST['lastName']) ? '' : $_POST['lastName'];
        
        $confirmPass = empty($_POST['confirmPass']) ? '' : $_POST['confirmPass'];
		$birthday = empty($_POST['birthday']) ? '' : $_POST['birthday'];
        
        $email = empty($_POST['email']) ? '' : $_POST['email'];
        
//        echo $username . "<br>";
//        echo $password . "<br>";
//        echo $firstName . "<br>";
//        echo $lastName . "<br>";
//        echo $confirmPass . "<br>";
//        echo $birthday . "<br>";
//        echo $email . "<br>";
        
        if( strcmp($password, $confirmPass)==0)
        {
//            echo "passwords are the same, ";
            //require the credentials
            require_once '../db.conf';
            //connect to the database
            $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
            
            if($conn -> connect_error)
            {
                echo "connection error";
            }
            else
            {
                //echo "connection successful, ";
            }
            $username = $conn->real_escape_string($username);
            $password = $conn->real_escape_string($password);
            $password = sha1($password);
            
            // do this for all variables first,last...
            
//            $query = "INSERT INTO users (firstName, lastName, username, password, email, birthday, addDate, changeDate) VALUES ('$firstName','$lastName','$username','$password','$email','$birthday', now(), now() )";
            
            $query = "INSERT INTO users (firstName, lastName, username, password, email, birthday, addDate, changeDate) VALUES ('$firstName','$lastName','$username','$password','$email', STR_TO_DATE('$birthday', '%Y-%m-%d'), now(), now() )";
//            print $query;
//            exit;
            
            if($conn->query($query) == TRUE)
            {
                $error= "new user created successfully";
                require "login_form.php";
                exit;
            }
            else
            {
                $error = "Insert error: " . $query . "<br>". $conn->error;
                require "createUser_form.php";
                exit;
            }
            
            $conn->close();
            
        }
        else
        {
            $error='Error: Passwords do not match.';
            require 'createUser_form.php';
            exit;
        }
	
//        /*
//		if ($username == "test" && $password == "pass") {
//			// Instead of setting a cookie, we'll set a key/value pair in $_SESSION
//			$_SESSION['loggedin'] = $username;
//			header("Location: page1.php");
//			exit;
//		}
//        */
//        
//        // We added the test user to our users table
//        // INSERT INTO users (username, password, addDate, changeDate) VALUES ('test', 'pass', NOW(), NOW());
//        
//        
//        // Require the credentials
//        require_once '../db.conf';
//        
//        // Connect to the database
//        $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
//        
//        // Check for errors
//        if ($mysqli->connect_error) {
//            $error = 'Error: ' . $mysqli->connect_errno . ' ' . $mysqli->connect_error;
//			require "login_form.php";
//            exit;
//        }
//        
//        // http://php.net/manual/en/mysqli.real-escape-string.php
//        $username = $mysqli->real_escape_string($username);
//        $password = $mysqli->real_escape_string($password);
//        
//        //more secure password storing for website
//        $password = sha1($password); 
//        
//        // Build query
//		$query = "SELECT id FROM users WHERE userName = '$username' AND password = '$password'";
//		
//        // Sometimes it's nice to print the query. That way you know what SQL you're working with.
//        //print $query;
//        //exit;
//        
//		// Run the query
//		$mysqliResult = $mysqli->query($query);
//		
//        // If there was a result...
//        if ($mysqliResult) {
//            // How many records were returned?
//            $match = $mysqliResult->num_rows;
//
//            // Close the results
//            $mysqliResult->close();
//            // Close the DB connection
//            $mysqli->close();
//
//
//            // If there was a match, login
//  		    if ($match == 1) {
//                $_SESSION['loggedin'] = $username;
//                header("Location: page1.php");
//                exit;
//            }
//            else {
//                $error = 'Error: Incorrect username or password';
//                require "login_form.php";
//                exit;
//            }
//        }
//        // Else, there was no result
//        else {
//          $error = 'Login Error: Please contact the system administrator.';
//          require "login_form.php";
//          exit;
//        }
	}
	
	function login_form() {
		$username = "";
		$error = "";
		require "login_form.php";
        exit;
	}
	
?>
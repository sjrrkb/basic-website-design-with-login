<?php
    // HTTPS redirect
    if ($_SERVER['HTTPS'] !== 'on') {
		$redirectURL = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		header("Location: $redirectURL");
		exit;
	}
    
	// Every time we want to access $_SESSION, we have to call session_start()
	if(!session_start()) {
		header("Location: error.php");
		exit;
	}
	
	$loggedIn = empty($_SESSION['loggedin']) ? false : $_SESSION['loggedin'];
	if (!$loggedIn) {
		header("Location: login.php");
		exit;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome!</title>
    <link href="../app.css" rel="stylesheet" type="text/css">
    <link href="../jquery-ui-1.11.4.custom/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <script src="../jquery-ui-1.11.4.custom/external/jquery/jquery.js"></script>
    <script src="../jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
    <style>
        body
        {
            background-image: url("welcomeBackground.jpg");
        }
    </style>
</head>
<body>
    <div class="ui-widget pageWidget">
        <h1 class="ui-widget-header">Welcome!</h1>
        <div class="ui-widget-content">
            <p>This is a page containing protected content<?php print " for $loggedIn"; ?>.</p>
            <p>You must be logged in to view this page.</p>
            <p><a href='../Quizz/quizApp.php' style="color:blue">Take a quiz!</a><a>  </a><a href='../recordPlayer/recordPlayer.php' style="color:blue">Listen to some tunes?!?</a></p>
            <p><a href='../contact/contact.php' style="color:red">Contact Admin</a><a>  </a><a href='logout.php' style="color:red">Logout</a></p>
            <p><a href='../requirements/requirements.php' style="color:blue">Requirments for Final Project Writeup</a></p>
            
        </div>
    </div>
</body>
</html>
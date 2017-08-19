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
        <meta charset="utf-8">
        <title>Contact Form</title>
        <script src="jquery-2.1.0.min.js"></script>
        <script src="app.js"></script>
        <link href="../app.css" rel="stylesheet" type="text/css">
        <link href="../jquery-ui-1.11.4.custom/jquery-ui.min.css" rel="stylesheet" type="text/css">
        <script src="jquery-ui-1.11.4.custom/jquery-ui.js"></script>
        <style>
            div .ui-widget pageWidget
            {
                text-align: center;
                width: 600px;
                margin-top: .67em auto;
                margin-bottom: .67em auto;
                margin-left: 500px;
                margin-right: .67em;
            }
            h1
            {
                text-align: center;
            }
            .field
            {
                text-align: center;
                font-family: sans-serif, cursive;
            }
            #form-messages
            {
                text-align: center;
                font-family: sans-serif, cursive;
            }
            body
            {
                background-image: url("contactBackground.jpg");
            }
        </style>
    </head>
    <body>
        <div class="ui-widget pageWidget">
        <h1 class="ui-widget-header">Contact Info</h1>
        <div class="ui-widget-content">
            <p>This is a page containing protected content<?php print " for $loggedIn"; ?>.</p>
            <p>You must be logged in to view this page.</p>
            <p><a href='../Quizz/quizApp.php' style="color:blue">Take a quiz!</a><a>  </a><a href='../recordPlayer/recordPlayer.php' style="color:blue">Listen to some tunes?!?</a></p>
            <p><a href='contact.php' style="color:red">Contact Admin</a><a>  </a><a href='../3. createUser/logout.php' style="color:red">Logout</a></p>
            <p><a href='../requirements/requirements.php' style="color:blue">Requirments for Final Project Writeup</a></p>
        </div>
        </div>
        <form id="ajax-contact" method="POST" action="mailer.php">
            <div class="field">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="field">
                <label for="message">Message:</label>
                <textarea id="message" name="message" required></textarea>
            </div>

            <div class="field">
                <button type="submit">Send</button>
            </div>
            <div id="form-messages"></div>
        </form>
    </body>
</html>
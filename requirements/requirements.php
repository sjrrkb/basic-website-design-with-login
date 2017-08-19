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
	<title>Final Project Requirements</title>
    <script src="../jquery-1.11.2.min.js"></script>
    <link href="../app.css" rel="stylesheet" type="text/css">
    <link href="../jquery-ui-1.11.4.custom/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <script src="../jquery-ui-1.11.4.custom/jquery-ui.js"></script>
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
        h1, div
            {
                text-align: center;
                font-family: sans-serif, fantasy;
            }
        body, div .ui-widget-content
        {
            background-image: url("requirementsBackground.jpg");
        }
        .the
        {
            display: inline-block;
            font-size: 1.5em;
            margin: 1.5em;
        }
        #infoBox
        {
            font-weight: bold;
            font-size: 1.5em;
        }
    </style>
	<script>
	function updateInfo(quoteID) {
		var xmlHttp = new XMLHttpRequest();
		
		xmlHttp.onload = function() {
			if (xmlHttp.status == 200) {
				var infoBox = document.getElementById('infoBox');
				infoBox.innerHTML = xmlHttp.responseText;
			  }
		}
		
        // Append GET data to identify which quote we want
        var reqURL = "quoteService.php?infoId=" + quoteID;
        
		xmlHttp.open("GET", reqURL, true);
		xmlHttp.send();
	}
	
	</script>
</head>
<body>
    <div class="ui-widget pageWidget">
        <h1 class="ui-widget-header">Requirments Writeup For Final Project</h1>
        <div class="ui-widget-content">
            <p>This is a page containing protected content<?php print " for $loggedIn"; ?>.</p>
            <p>You must be logged in to view this page.</p>
            <p><a href='../Quizz/quizApp.php' style="color:blue">Take a quiz!</a><a>  </a><a href='../recordPlayer/recordPlayer.php' style="color:blue">Listen to some tunes?!?</a></p>
            <p><a href='../contact/contact.php' style="color:red">Contact Admin</a><a>  </a><a href='../3. createUser/logout.php' style="color:red">Logout</a></p>
            <p><a href='requirements.php' style="color:blue">Requirments for Final Project Writeup</a></p>
        </div>
        </div>
	<h1>Click a button to see where each requirement for the final project is fulfilled</h1>
	<div id="buttonBox">
        <input class="the" type="button" value="HTML/CSS Requirements" onclick="updateInfo('quote1')">
        <input class="the"type="button" value="Consistent UI " onclick="updateInfo('quote2')">
        <input class="the" type="button" value="PHP" onclick="updateInfo('quote3')">
        <input class="the" type="button" value="GET & POST" onclick="updateInfo('quote4')">
        <input class="the" type="button" value="FORM elements" onclick="updateInfo('quote5')">
        <input class="the" type="button" value="USER feedback" onclick="updateInfo('quote6')">
        <input class="the" type="button" value="Photos & Videos" onclick="updateInfo('quote7')">
        <input class="the" type="button" value="Javascript and jQUERY" onclick="updateInfo('quote8')">
        <input class="the" type="button" value="AJAX" onclick="updateInfo('quote9')">
    </div>
    <div id="infoBox"></div>
</body>
</html>
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
		<title>Record Player</title>
        <style>
            #recordPlayer {
                background-image: url(../images/recordPlayer.jpg);
                width: 300px;
                height: 266px;
                margin: 15px auto;
            }
            #message {
                text-align: center;
            }
            #music {
                list-style: none;
                text-align: center;
            }
            #music > li {
                display: inline-block;
            }
            .record{
                width: 100px;
            }
            audio{
                display: none;
            }
            div .ui-widget pageWidget
            {
                text-align: center;
                width: 600px;
                margin-top: .67em auto;
                margin-bottom: .67em auto;
                margin-left: 500px;
                margin-right: .67em;
            }
            body
            {
                background-image: url("recordBackground.jpg");
            }
            div .ui-widget-content
            {
                background-image: url("recordBackground.jpg");
                border-image: url("recordBackground.jpg");
            }
        </style>
        <link href="../app.css" rel="stylesheet" type="text/css">
        <link href="../jquery-ui-1.11.4.custom/jquery-ui.min.css" rel="stylesheet" type="text/css">
        <script src="../jquery-ui-1.11.4.custom/external/jquery/jquery.js"></script>
        <script src="../jquery-ui-1.11.4.custom/jquery-ui.js"></script>
        <script>
        function revertDraggable($selector) 
        {
            $selector.each(function() {
                var $this = $(this),
                    position = $this.data("originalPosition");

                if (position) {
                    $this.animate({
                        left: position.left,
                        top: position.top
                    }, 500, function() {
                        $this.data("originalPosition", null);
                    });
                }
            });
        }
        $(function()
        {
            $(".record").draggable
            ({
                revert: "invalid"                
            });
            $("#recordPlayer").droppable
            ({
                drop: function(event, ui)
                {
//                    if (!ui.draggable.data("originalPosition")) 
//                    {
//                        ui.draggable.data("originalPosition",
//                        ui.draggable.data("draggable").originalPosition);
//                    }   
                    var record= ui.draggable;
                    var artist= record.prop("alt");
                    $("#message").html("Now playing: " + artist);
                    record.fadeOut();
                    switch(artist)
                        {
                            case "Kings of Leon":
                                $(".audioDemo").trigger('pause');
                                $("#audio1").trigger('play');
                                $("#audio1").fadeout();
                                break;
                            case "Beatles":
                                $(".audioDemo").trigger('pause');
                                $("#audio2").trigger('play');
                                $("#audio2").fadeout();
                                break;
                            case "Bruno Mars":
                                $(".audioDemo").trigger('pause');
                                $("#audio3").trigger('play');
                                $("#audio3").fadeout();
                                break;
                            case "Monster Mash":
                                $(".audioDemo").trigger('pause');
                                $("#audio5").trigger('play');
                                $("#audio5").fadeout();
                                break;
                            case "Chopstick Brothers":
                                $(".audioDemo").trigger('pause');
                                $("#audio4").trigger('play');
                                $("#audio4").fadeout();
                                break;
                            default:
                                $(".audioDemo").trigger('pause');
                                $("#message").html("Stop Playing");
                                break;
                        }
                    if(artist != "Stop")
                    {
                       record.fadeOut(); 
                    }
                }
            });
            $("#undo").click(function() 
            {
                revertDraggable($(".drag"));
            });
         }); 
        </script>
	</head>
	<body>
        <div class="ui-widget pageWidget">
        <h1 class="ui-widget-header">Record Player</h1>
        <div class="ui-widget-content">
            <p>This is a page containing protected content<?php print " for $loggedIn"; ?>.</p>
            <p>You must be logged in to view this page.</p>
            <p><a href='../Quizz/quizApp.php' style="color:blue">Take a quiz!</a><a>  </a><a href='recordPlayer.php' style="color:blue">Listen to some tunes?!?</a></p>
            <p><a href='../contact/contact.php' style="color:red">Contact Admin</a><a>  </a><a href='../3. createUser/logout.php' style="color:red">Logout</a></p>
            <p><a href='../requirements/requirements.php' style="color:blue">Requirments for Final Project Writeup</a></p>
        </div>
        </div>
        <div id="recordPlayer"></div>
        <h1 id="message">Drop a record onto record player to listen to some tunes!</h1>
        <ul id="music">
            <iframe width="420" height="315"src="https://www.youtube.com/embed/CE-JlvmnRtY" frameborder="0" allowfullscreen></iframe>
            <li \><img class="record" src="../images/KOL.png" alt="Kings of Leon" id="kings"></li> 
            <li><img class="record" src="../images/beatles.png" alt="Beatles"></li> 
            <li><img class="record" src="../images/bruno-mars-24k-magic-1475846353-compressed.jpg" alt="Bruno Mars"></li> 
            <li><img class="record" src="../images/chopstickbrothers.jpg" alt="Chopstick Brothers"></li> 
            <li><img class="record" src="../images/mash.png" alt="Monster Mash"></li> 
            <li><img class="record" src="../images/stop.png" alt="Stop"></li> 
            <iframe width="420" height="315" src="https://www.youtube.com/embed/4r7wHMg5Yjg" frameborder="0" allowfullscreen></iframe>
        </ul>
        
        <audio class="audioDemo" id="audio1" controls preload="none">
            <source src="../audio/Kings%20of%20leon%20-%20King%20of%20the%20rodeo.mp3" type="audio/mpeg" />
        </audio>
        <audio class="audioDemo" id="audio2" controls preload="none">
            <source src="../audio/Come%20Together.mp3" type="audio/mpeg" />
        </audio>
        <audio class="audioDemo" id="audio3" controls preload="none">
            <source src="../audio/Bruno%20Mars%2024K%20Magic.mp3" type="audio/mpeg" />
        </audio>
        <audio class="audioDemo" id="audio4" controls preload="none">
            <source src="../audio/%CF%84%C2%A1%E2%95%96%CF%83%C2%A1%C3%89%CF%83%C3%A0%C3%A4%CF%83%E2%95%9D%C6%92-%CF%83%E2%96%91%C3%85%CE%A6%C3%BF%C3%AF%C2%B5%E2%82%A7%C2%A3KTV%CF%84%C3%AB%C3%AA.mp3" type="audio/mpeg" />
        </audio>
        <audio class="audioDemo" id="audio5" controls preload="none">
            <source src="../audio/Monster%20Mash.mp3" type="audio/mpeg" />
        </audio>
	</body>
</html>
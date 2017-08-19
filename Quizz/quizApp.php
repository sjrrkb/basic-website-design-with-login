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
        <title>Homemade Quiz Application</title>
        <script src="../jquery-1.11.2.min.js"></script>
        <link href="../app.css" rel="stylesheet" type="text/css">
        <link href="../jquery-ui-1.11.4.custom/jquery-ui.min.css" rel="stylesheet" type="text/css">
        <script src="../jquery-ui-1.11.4.custom/jquery-ui.js"></script>
        <style>
            *
            {
                font-family: sans-serif, fantasy;
            }
            #wrapperDiv
            {
                margin-left: 20em;
                width: 60%;
            }
            #submit
            {
                width: auto;
                height: auto;
                font-size: 1em;
                background-color: red;
                text-align: center;
            }
            #instructions
            {
                font-size: 1.5em;
            }
            #titleHeader
            {
                font-size: 3em;
                text-align: center;
            }
            #questionHeader
            {
                text-align: center;
            }
            #choices
            {
                width: auto;
                height: auto;
                display: inline-block;
                text-align: center;
            }
            #contentDiv
            {
                text-align: center;
            }
            #results
            {
                text-align: center;
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
                background-image: url("quizBackground.jpg");
            }
            div .ui-widget-content
            {
                background-image: url("quizBackground.jpg");
                border-image: url("quizBackground.jpg");
            }
        </style>
        <script>
            var quiz =
                [
                    {
                        "question": "What is 1+1 equal to?",
                        "choices": ["1","2","3","4"],
                        "correct": "2"
                    },
                    {
                        "question": "What is the Completeness Axiom?",
                        "choices": ["Every non-empty set in R that is bounded above has a supremum","Every non-empty set in R that is bounded below has a supremum","Every non-empty set in R that is bounded above has an infinum","Every non-empty set in R that is bounded below has an infinum"],
                        "correct": "Every non-empty set in R that is bounded above has a supremum"
                    },
                    {
                        "question": "What is the square of 12",
                        "choices": ["12","24","36","144"],
                        "correct": "144"
                    }
                ];
            var current=0;
            var score=0;
            var output="";
            var questionHeader="";
            var questionResult="";
            var asking=true;
            var submission="Submit Answer";
            $(document).ready(function()
            {
                askQuestion();
                $("#submit").click(function()
                {
                     answerChecker();  
                });
                
            });
            function askQuestion()
            {
                var userChoice=quiz[current].choices;
                output="";
                $("#choices").html(output);
                for(var i=0; i<(userChoice.length);i++)
                {
                    output+= "<input type='radio' name='quiz" + current +
                        "' id='choice" + (i + 1) +
                        "' value='" + userChoice[i] + "'>" +
                        "<label for='choice" + (i+1) + "'>" + userChoice[i] + "</label>"
                        "<input type='radio' name='quiz" + current +
                        "' id='choice" + (i + 2) +
                        "' value='" + userChoice[i+1] + "'>" +
                        "<label for='choice" + (i+2) + "'>" + userChoice[i+1] + "</label><br>";
                }
                $("#choices").html(output);
                questionHeader= "Q" + (current + 1) + ": " + quiz[current].question;
                $("#questionHeader").html(questionHeader);
                if(current===0)
                    {
                        questionResult="Score: 0 right answers out of " + quiz.length + " possible.";
                        $("#results").html(questionResult);
                        document.getElementById("submit").innerHTML= "Submit Answer";
                    }
            }
            function answerChecker()
            {
                if(asking)
                    {
                        document.getElementById("submit").innerHTML= "Next Question"; 
                        asking = false;
                        var userChoice;
                        var index=0;
                        var radios = document.getElementsByName("quiz" + current);
                        for (var i=0; i<radios.length; i++)
                            {
                                if(radios[i].checked)
                                    {
                                        userChoice=radios[i].value;
                                    }
                                if(radios[i].value == quiz[current].correct)
                                    {
                                        index=i;
                                    }
                            }
                        var label=document.getElementsByTagName("label")[index].style;
                        label.fontWeight="bold";
                        if(userChoice == quiz[current].correct)
                            {
                                score++;
                                label.color="green";
                            }
                        else
                            {
                                label.color="red";    
                            }
                    questionResult="Score: " + score + " right answers out of " + quiz.length + " possible.";
                    $("#results").html(questionResult);
                    }
                else
                {
                    console.log('This tells me I got to change asking to true');
                    asking=true;
                    document.getElementById("submit").innerHTML="Submit Answer";
                    if(current<quiz.length -1)
                        {
                            current++;
                            askQuestion();
                        }
                    else
                    {
                        showResults();
                    }  
                } 
            }
            function showResults()
            {
                var finalResult="<h2> You have successfully finished the quiz </h2>" + "<h2>Below are your results:</h2>" + "<h2>" + score + " out of " +
                    quiz.length + " questions, " + Math.round(score/quiz.length*100) + "%</h2>";
                $("#instructions").html("");
                $("#contentDiv").css("text-align","center");
                $("#contentDiv").html(finalResult);
            }
        </script>
    </head>
    <body>
        <div class="ui-widget pageWidget">
        <h1 class="ui-widget-header">Quiz Page</h1>
        <div class="ui-widget-content">
            <p>This is a page containing protected content<?php print " for $loggedIn"; ?>.</p>
            <p>You must be logged in to view this page.</p>
            <p><a href='quizApp.php' style="color:blue">Take a quiz!</a><a>  </a><a href='../recordPlayer/recordPlayer.php' style="color:blue">Listen to some tunes?!?</a></p>
            <p><a href='../contact/contact.php' style="color:red">Contact Admin</a><a>  </a><a href='../3. createUser/logout.php' style="color:red">Logout</a></p>
            <p><a href='../requirements/requirements.php' style="color:blue">Requirments for Final Project Writeup</a></p>
        </div>
        </div>
        <div id="wrapperDiv">
            <h1 id="titleHeader">Quiz Fun Time!</h1>
            <p id="instructions">Select the correct answer from a list of choices. No partial credit given nor credit for unanswered questions.</p>
            <div id="contentDiv">
                <h2 id="questionHeader"></h2>
                <div id="choices"></div>
                <p><button id="submit">Submit Answer</button></p>
                <p id="results"></p>
            </div>
        </div>
    </body>
</html>
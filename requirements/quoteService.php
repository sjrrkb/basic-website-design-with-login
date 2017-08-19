<?php
$infoId = empty($_GET['infoId']) ? 'quote0' : $_GET['infoId'];

switch($infoId) {
	case 'quote1':
		$info = '<br>All pages on this website utilize proper HTML/CSS along with required tags.<br><br> This includes the login.php, requirements.php, quiz.php, contact.php, and recordPlayer.php. <br>';
		break;
	case 'quote2':
		$info = '<br> Each page has identical header creating a consistent UI. <br>';
		break;
	case 'quote3':
		$info = '<br>All pages utilize PHP in order to allow each page to be login/password protected. <br><br>At the top of login.php, requirements.php, quiz.php, contact.php, and recordplayer.php one can see this. <br><br> In addition, the login/createuser/logout functions utilize PHP.<br>';
		break;
	case 'quote4':
		$info = '<br>The login.php and contact.php  pages utilize POST. <br><br>The requiments.php page uses GET.<br>';
		break;
    case 'quote5':
		$info = '<br>The login.php, createuser.php, contact.php all utilize FORMS.<br>';
		break;
    case 'quote6':
		$info = '<br>User feedback occurs on the createuser page when the user must input the passwords. <br><br>When the password and confirm password input does not match, 
        the user is informed of this. <br><br> In addition, if the user fails to login with correct info, they are informed of such and redirected to the login page.<br>';
		break;
    case 'quote7':
		$info = '<br>Each page on this website has an image embedded into the background. <br><br>In addition, recordplayer.php utilizes both images and videos.<br>';
		break;
    case 'quote8':
		$info = '<br>The recordplayer.php, quizApp.php, and requirements.php use both Javascript and jQUERY.<br><br> In addition, the recordplayer.php uses jQUERY UI elements.<br>';
		break;
    case 'quote9':
		$info = '<br>The requirements.php uses AJAX and get to access quoteService.php and retrieve data without reloading the webpage.<br>';
		break;
	default: 
		$info = "YOU FAIL AT LIFE!?!"; 
		break;
}

print $info;
?>
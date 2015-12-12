<!DOCTYPE HTML>
<?php
session_start();
?>
<html lan="en">
<head>
	<title>Welcome to Perugini.co!</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="shortcut icon" href="public_html/favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body>

    <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a href="index.html" class="navbar-brand">TwitchDen</a>
            </div>
            <div class="navbar-collapse collapse" id="navbar-main">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="">Resume</a>
                    </li>
                    <li>
                        <a href="">About</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <?php
                            if(isset($_SESSION['username']))
                            {
                                echo "<a>Hi " . $_SESSION['firstName'] . " " . $_SESSION['lastName'] . "!</a></li>";
                                echo "<li><a href=\"/login_and_register/logout.php\">Logout</a>";
                            }
                            else
                            {
                                echo "<a href=\"login_and_register/login.php\">Login/Register</a>";
                            }
                            ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    </br>
    </br>
    </br>

	<div class="container">
		<h1>Success!  The perugini.co virtual host is working! Added TwitchPlaysPokemon chat to test API.</h1>
        <iframe style="width: 300px; height: 500px;" src="http://twitch.tv/twitchplayspokemon/chat?popout="></iframe>
	</div>
</body>
</html>

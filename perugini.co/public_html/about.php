<?php
session_start();
?>
<!DOCTYPE HTML>
<html lan="en">
<head>
	<title>Welcome to Perugini.co!</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="57x57" href="images/twitchicon.ico/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="images/twitchicon.ico/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/twitchicon.ico/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="images/twitchicon.ico/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/twitchicon.ico/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="images/twitchicon.ico/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="images/twitchicon.ico/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="images/twitchicon.ico/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/twitchicon.ico/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="images/twitchicon.ico/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/twitchicon.ico/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="images/twitchicon.ico/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/twitchicon.ico/favicon-16x16.png">
    <link rel="manifest" href="images/twitchicon.ico/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="images/twitchicon.ico/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <script src="httpFunctions.js"></script>
</head>
<body>

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main">
                <!--<span class="sr-only">Toggle navigation</span>-->
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
                <a href="index.php" class="navbar-brand">TwitchDen</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-main">
                <ul class="nav navbar-nav">
                    <li><a href="">Games</a></li>
                    <li><a href="">Channels</a></li>
                    <li><a href="about.php">About</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <?php
                            if(isset($_SESSION['username']))
                            {
                                echo "<a>Hi " . $_SESSION['firstName'] . " " . $_SESSION['lastName'] . "!</a></li>";
                                echo "<li><a href=\"login_and_register/logout.php\">Logout</a>";
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
    </nav>

    <br>
    <br>
    <br>
    <br>

    <div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">About TwitchDen</h3>
        </div>
        <div class="panel-body">
            <p>TwitchDen is a website I wanted to create to learn and brush up on web development from the ground up. I wanted to remember how to launch and set up a VPS, get apache, mongodb, git, etc set up, and to re-learn php. So far I've used php to set up the bulk of the site. It's handeling user login/logout right now (not that it's very useful right now).</p>
            <p>My goal for this site is to do some cool stuff with the Twitch API, like show stats such as current viewcount and streamcount. I want to be able to display live graphs/stats on twitch streams to show viewship over time. I think that'll be a pretty cool thing that would interest a lot of people, not just viewers. I'd also really like to make this more of a social space, where people can link their twitch accounts to their site accounts, add friends to their on-site account, and follow what their friends are watching. I'd like people to be able to find what channels their friends are following, what their friends are watching right now, and be able to share streams or talk about them in some way (not 100% sure about the last one).</p>
            <p>I think that twitch's api provides a lot of cool data that viewers usually don't get to see unless the broadcaster has some bot that allows them to type in commands. I know that there's a way to find how long a broadcaster has been streaming, and I'd like to maybe collect that data over time to show average stream time, and maybe auto-generate schedules for that time. What I mean by that is to gather start and end times, get the average start and average end time, and be able to display that information as a "Predicted Start Time: 12:30 PST" "Predicted Stream Length: 4 Hours" or something like that.</p>
            <p>I have a lot of learning to do, like learning how to integrate twitch accounts with site accounts, but I think I could make this site into something people would actually use.</p>
        </div>
    </div>

    <footer>
        <div class="row">
            <div class="col-lg-12">

                <ul class="list-inline">
                    <li class="pull-right"><a href="#top">Back to top</a></li>
                    <li><a href="www.twitch.tv">Twitch</a></li>
                    <li><a href="https://twitter.com/peruginim">Twitter</a></li>
                    <li><a href="https://github.com/peruginim">GitHub</a></li>
                    <li><a href="https://github.com/justintv/Twitch-API">API</a></li>
                </ul>
                <p>Made by <a href="" rel="nofollow">Michael Perugini</a> with <a href="https://github.com/justintv/Twitch-API">Twitch API</a>. Contact him at <a href="">11peruginiM@gmail.com.</p>
                <p>Based on <a href="http://getbootstrap.com" rel="nofollow">Bootstrap</a>. Icons from <a href="http://fortawesome.github.io/Font-Awesome/" rel="nofollow">Font Awesome</a>. Web fonts from <a href="http://www.google.com/webfonts" rel="nofollow">Google</a>. Twitch font from <a href="http://www.dafont.com/dimitri.font">dafont</a>.</p>

            </div>
        </div>
    </footer>
</div>
</body>
</html>

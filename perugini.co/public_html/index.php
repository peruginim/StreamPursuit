<?php
session_start();
?>
<!DOCTYPE HTML>
<html lan="en">
<head>
	<title>Welcome to Perugini.co!</title>
	<meta charset="UTF-8">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="httpFunctions.js"></script>
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
</head>
<body>

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main">
                <span class="sr-only">Toggle navigation</span>
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

    </br>
    </br>
    </br>

    <div class="container">
    <h1>Detailed twitch stats and more!</h1>
    <p>Connect with friends to find who they're following or currently watching. Detailed, live stats on twitch streams. You'll
        be able to see peaks in viewership. Get insight into popular streaming times both site-wide and streamer specific.</p>
    <!--<iframe style="width: 350px; height: 500px;" src="http://twitch.tv/twitchplayspokemon/chat?popout="></iframe>//-->
    <script type="text/javascript">
        
        function numberWithCommas(x) 
        { 
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","); 
        }
        //document.write(httpGet("https://api.twitch.tv/kraken/users/nezzi240p") + "</br>");
        //var twitchRequest = JSON.parse(httpGet("https://api.twitch.tv/kraken/users/nezzi240p"));
        //document.write(twitchRequest.display_name);
    </script>
    </br>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Twitch Stats</h3>
        </div>
        <div class="panel-body">
            <script type="text/javascript">
                var twitchSummary = JSON.parse(httpGet("https://api.twitch.tv/kraken/streams/summary"));
                var topGame = JSON.parse(httpGet("https://api.twitch.tv/kraken/games/top"));
                var topStream = JSON.parse(httpGet("https://api.twitch.tv/kraken/streams"));
            </script>
            <ul class="list-unstyled">
            <li>Current Streamers: <script type="text/javascript">document.write(numberWithCommas(twitchSummary.channels));</script></li>
            <li>Current Viewers: <script type="text/javascript">document.write(numberWithCommas(twitchSummary.viewers));</script></li>
            <li>Top Game: <script type="text/javascript">document.write(topGame.top[0].game.name);</script></li>
            <li>Top Stream: <script type="text/javascript">document.write(topStream.streams[0].channel.display_name);</script></li>
            </ul>
            <script type="text/javascript">
                
            </script>
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

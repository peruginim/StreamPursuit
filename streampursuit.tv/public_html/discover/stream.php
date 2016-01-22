<?php
session_start();
?>
<!doctype html>
<html lan="en">
<head>
    <title>Welcome to StreamPursuit!</title>
	<meta charset="UTF-8">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="//code.jquery.com/jquery.min.js"></script>
    <script src="../js/twitch.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../httpFunctions.js"></script>
    <script src="../utilityFunctions.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="57x57" href="../images/twitchicon.ico/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="../images/twitchicon.ico/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../images/twitchicon.ico/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../images/twitchicon.ico/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../images/twitchicon.ico/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../images/twitchicon.ico/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../images/twitchicon.ico/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../images/twitchicon.ico/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../images/twitchicon.ico/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="../images/twitchicon.ico/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../images/twitchicon.ico/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../images/twitchicon.ico/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/twitchicon.ico/favicon-16x16.png">
    <link rel="manifest" href="../images/twitchicon.ico/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../images/twitchicon.ico/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <script>
    window.CLIENT_ID = '2p0yndyzg3qjty0yfbywvngdgirwkev';
    $(function() {
        // Initialize. If we are already logged in, there is no
        // need for the connect button
        Twitch.init({
            clientId: CLIENT_ID
        }, function(error, status) {
            if (status.authenticated) {
                // Show the data for logged-in users
                $('.authenticated').removeClass('hidden');
            } else {
                // Show the twitch connect button
                $('.authenticate').removeClass('hidden');
            }
        });


        $('.twitch-connect').click(function() {
            Twitch.login({
				scope: ['user_read', 'channel_read', 'user_follows_edit'],
				redirect_uri: 'http://streampursuit.tv'
                //redirect_url: 'http://localhost/perugini.co/StreamPursuit/streampursuit.tv/public_html/index.php'
            });
        })

        $('.twitch-logout').click(function() {
            Twitch.logout();

            // Reload page and reset url hash. You shouldn't
            // need to do this.
            window.location = window.location.pathname
        })

    });
    </script>
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
                <a href="../index.php" class="navbar-brand">SP<sup style="font-family:'Government'"><b>[Beta]</b></sup></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-main">
                <ul class="nav navbar-nav">
                    <li><a href="discover.php"><i class="fa fa-binoculars"></i>Discover</a></li>
                    <li><a href="../about.php"><i class="fa fa-code"></i>About</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="authenticate hidden">
                        <a class="twitch-connect" href="#" style="font-family:'Dimitri'"><i class="fa fa-twitch"></i> Connect with Twitch</a>
                    </li>
                    <li class="authenticated hidden">
                        <a id="welcome_user" href="#" style="font-family: 'Helvetica Neue'">
                            <script>
                                $(function() {
                                    Twitch.api({
                                        method: 'user'
                                    }, function(error, user) {
                                        document.getElementById("welcome_user").innerHTML = "<b>" + "Welcome " + user.display_name + "<b/>";
                                    });
                                });
                            </script></a>
                    </li>
                    <li class="authenticated hidden">

                        <a class="twitch-logout" href="#" style="font-family:'Dimitri'"><i class="fa fa-sign-out"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <br/>
    <br/>
    <br/>
    <br/>

    <div class="container">
        <script>
            var gamesList = JSON.parse(httpGet("https://api.twitch.tv/kraken/games/top?limit=100"));
            var gameCount = gamesList.top.length;
            var gameIndex = getRandomInt(0, gameCount);
            var game = sanitizeGame(gamesList.top[gameIndex].game.name);
            var streamsList = JSON.parse(httpGet("https://api.twitch.tv/kraken/streams?game=" + game + "&limit=100"));
            var streamCount = streamsList.streams.length;
            var streamIndex = getRandomInt(0, streamCount);
            var streamerName = streamsList.streams[streamIndex].channel.name;
        </script>
        <div class="container">
            <div class="row no-gutter">
                <div class="col-md-1">
                    <center>
                    <script>document.write("<img src =" + streamsList.streams[streamIndex].channel.logo + " style=\"width:60px;height:60px;\">");</script>
                   </center>
                </div>
                <div class="col-md-10">
                    <div class="title">
                        <font size="5"><script>document.write(streamsList.streams[streamIndex].channel.status);</script></font>
                    </div>
                    <div class="channel">
                        <script>
                            document.write("<a href=\"http://www.twitch.tv/"
                                           + streamerName + "/profile\">" + streamsList.streams[streamIndex].channel.display_name
                                           + "</a> playing <a href=\"http://twitch.tv/directory/game/" + game + "\">"
                                           + streamsList.streams[streamIndex].channel.game + "</a>");
                        </script>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <script>
                        document.write("<iframe src=\"http://player.twitch.tv/?channel="
                                       + streamerName + "\" height=\"500\" width=\"100%\" frameborder=\"0\" scrolling=\"no\" allowfullscreen> </iframe>");
                    </script>
                </div>
                <div class="col-md-3">
                    <script>
                        document.write("<iframe frameborder=\"0\" scrolling=\"no\" id=\"chat_embed\" src=\"http://www.twitch.tv/"
                                      + streamerName + "/chat\" height=\"500\" width=\"100%\"> </iframe>");
                    </script>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <a href="#" class="btn btn-primary btn-lg btn-block" id="like-button"><i class="fa fa-check"></i> Like</a>
                </div>
                <div class="col-md-4">
                    <a href="stream.php" class="btn btn-primary btn-lg btn-block" id="reroll-button"><i class="fa fa-repeat"></i> ReRoll</a>
                </div>
                <div class="col-md-4">
                    <a href="#" class="btn btn-primary btn-lg btn-block" id="follow-button" onclick="follow(streamerName)"><i class="fa fa-heart"></i> Follow</a>
                </div>
            </div>
            <br/>
            <p class="text-muted">To watch this channel on Twitch, click <script>document.write("<a href=" + streamsList.streams[streamIndex].channel.url + ">here</a>");</script>!</p>
        </div>
    </div>
    <br/>
    <div class="container">
       <center>
            <footer>
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="list-inline">
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
        </center>
    </div>
</body>
</html>

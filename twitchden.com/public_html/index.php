<?php
session_start();
?>
<!DOCTYPE HTML>
<html lan="en">
<head>
	<title>Welcome to TwitchDen!</title>
	<meta charset="UTF-8">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="//code.jquery.com/jquery.min.js"></script>
    <!--<script src="https://ttv-api.s3.amazonaws.com/twitch.min.js"></script>-->
    <script src="js/twitch.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        function drawChart() {
            var public_key = 'NJGqaM0GGbtRrOrd3DOd';

            var jsonData = $.ajax({
            url: 'https://data.sparkfun.com/output/' + public_key + '.json',
            //data: {page: 1},
            data: 'gt[timestamp]=now%20-1day',
            dataType: 'jsonp',
            }).done(function (results) {
                var data = new google.visualization.DataTable();

                data.addColumn('datetime', 'Time');
                data.addColumn('number', 'Viewers');

                var options = {
                    title: 'Twitch Viewers',
                    backgroundColor: '#303030', // Was #222222
                    animation: {"startup": true, duration: 1200, easing: 'out'},
                    titleTextStyle: {
                        color: '#ffffff'
                    },
                    hAxis: {
                        textStyle: {
                            color: '#ffffff'
                        },
                        titleTextStyle: {
                            color: '#ffffff'
                        }
                    },
                    vAxis: {
                        minValue: 0,
                        textStyle: {
                            color: '#ffffff'
                        }
                    },
                    legend: {
                        position: 'none'
                    },
                    series: {
                        0: {color: '#7555B1'} // Purple color that was mixed between twitch dark purple and light purple.
                    }
                };
                // loop through results and log temperature to the console
                $.each(results, function (i, row) {
                    //if($('#graph_progress').width <= 100)
                    //    $('#graph_progress').width($('#graph_progress').width + 1);
                    //document.getElementById("graph_progress").style.width = i + '%';
                    data.addRow([
                        (new Date(row.timestamp)),
                        parseFloat(row.viewers)
                    ]);
                });
                var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
                //$('.progress').removeClass('progress-striped');
                $('.progress').remove();
                $('.chart_div').removeClass('hidden');
                chart.draw(data, options);
            });
        }
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);
    </script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="httpFunctions.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
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
    <script>
    window.CLIENT_ID = '2p0yndyzg3qjty0yfbywvngdgirwkev';
    $(function() {
        // Initialize. If we are already logged in, there is no
        // need for the connect button
        Twitch.init({
            clientId: CLIENT_ID
        }, function(error, status) {
            if (status.authenticated) {
                // we're logged in :)
                $('.status input').val('Logged in! Allowed scope: ' + status.scope);
                // Show the data for logged-in users
                $('.authenticated').removeClass('hidden');
            } else {
                $('.status input').val('Not Logged in! Better connect with Twitch!');
                // Show the twitch connect button
                $('.authenticate').removeClass('hidden');
            }
        });


        $('.twitch-connect').click(function() {
            Twitch.login({
				scope: ['user_read', 'channel_read'],
				//redirect_uri: 'http://twitchden.com'
                redirect_url: 'http://localhost/perugini.co/TwitchDen/twitchden.com/public_html/index.php'
            });
        })

        $('.twitch-logout').click(function() {
            Twitch.logout();

            // Reload page and reset url hash. You shouldn't
            // need to do this.
            window.location = window.location.pathname
        })

        $('#get-name button').click(function() {
            Twitch.api({
                method: 'user'
            }, function(error, user) {
                $('#get-name input').val(user.display_name);
            });
        })

        $('#get-stream-key button').click(function() {
            Twitch.api({
                method: 'channel'
            }, function(error, channel) {
                $('#get-stream-key input').val(channel.stream_key);
            });
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
                <a href="index.php" class="navbar-brand">TwitchDen<sup style="font-family:'Helvetica Neue'"><b>[Beta]</b></sup></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-main">
                <ul class="nav navbar-nav">
                    <li><a href="discover/discover.php"><i class="fa fa-binoculars"></i>Discover</a></li>
                    <li><a href="about.php"><i class="fa fa-code"></i>About</a></li>
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
        <div class="jumbotron">
            <h1>Welcome!</h1>
            <p>TwitchDen let's you connect with Twitch and discover cool new chanels. Once your connected, head over to the Discover section to start watching a random stream! Once there you can like the channel, follow, or even reroll for a new stream. You can also check out these sweet stats from Twitch.</p>
        <script>

            function numberWithCommas(x)
            {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
        </script>
        <br/>
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="col-md-8">
                        <div class="progress progress-striped active" style="margin-top: 80px; margin-bottom: 80px;">
                            <div class="graph_progress progress-bar" style="width: 100%"></div>
                        </div>
                        <div id="chart_div" class="chart_div hidden" style="width: 100%; height: 180px; overflow: show;"></div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Twitch Summary</h3>
                            </div>
                            <div class="panel-body">
                                <script type="text/javascript">
                                    var twitchSummary = JSON.parse(httpGet("https://api.twitch.tv/kraken/streams/summary"));
                                    var topGame = JSON.parse(httpGet("https://api.twitch.tv/kraken/games/top"));
                                    var topStream = JSON.parse(httpGet("https://api.twitch.tv/kraken/streams"));
                                </script>
                                <ul class="list-unstyled">
                                    <li>Current Streamers:
                                        <script type="text/javascript">
                                            document.write(numberWithCommas(twitchSummary.channels));
                                        </script>
                                    </li>
                                    <li>Current Viewers:
                                        <script type="text/javascript">
                                            document.write(numberWithCommas(twitchSummary.viewers));
                                        </script>
                                    </li>
                                    <li>Top Game:
                                        <script type="text/javascript">
                                            document.write(topGame.top[0].game.name);
                                        </script>
                                    </li>
                                    <li>Top Stream:
                                        <script type="text/javascript">
                                            document.write(topStream.streams[0].channel.display_name);
                                        </script>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="col-md-6">
                    <table class="table table-striped table-hover" border="1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Top 10 Games</th>
                                <th>Viewers</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><script>document.write(topGame.top[0].game.name);</script></td>
                                <td><script>document.write(numberWithCommas(topGame.top[0].viewers));</script></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><script>document.write(topGame.top[1].game.name);</script></td>
                                <td><script>document.write(numberWithCommas(topGame.top[1].viewers));</script></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><script>document.write(topGame.top[2].game.name);</script></td>
                                <td><script>document.write(numberWithCommas(topGame.top[2].viewers));</script></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td><script>document.write(topGame.top[3].game.name);</script></td>
                                <td><script>document.write(numberWithCommas(topGame.top[3].viewers));</script></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td><script>document.write(topGame.top[4].game.name);</script></td>
                                <td><script>document.write(numberWithCommas(topGame.top[4].viewers));</script></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td><script>document.write(topGame.top[5].game.name);</script></td>
                                <td><script>document.write(numberWithCommas(topGame.top[5].viewers));</script></td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td><script>document.write(topGame.top[6].game.name);</script></td>
                                <td><script>document.write(numberWithCommas(topGame.top[6].viewers));</script></td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td><script>document.write(topGame.top[7].game.name);</script></td>
                                <td><script>document.write(numberWithCommas(topGame.top[7].viewers));</script></td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td><script>document.write(topGame.top[8].game.name);</script></td>
                                <td><script>document.write(numberWithCommas(topGame.top[8].viewers));</script></td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td><script>document.write(topGame.top[9].game.name);</script></td>
                                <td><script>document.write(numberWithCommas(topGame.top[9].viewers));</script></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-striped table-hover" border="1">
                        <thead>
                            <th>#</th>
                            <th>Top 10 Streams</th>
                            <th>Viewers</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><script>document.write(topStream.streams[0].channel.display_name);</script></td>
                                <td><script>document.write(numberWithCommas(topStream.streams[0].viewers));</script></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><script>document.write(topStream.streams[1].channel.display_name);</script></td>
                                <td><script>document.write(numberWithCommas(topStream.streams[1].viewers));</script></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td><script>document.write(topStream.streams[2].channel.display_name);</script></td>
                                <td><script>document.write(numberWithCommas(topStream.streams[2].viewers));</script></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td><script>document.write(topStream.streams[3].channel.display_name);</script></td>
                                <td><script>document.write(numberWithCommas(topStream.streams[3].viewers));</script></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td><script>document.write(topStream.streams[4].channel.display_name);</script></td>
                                <td><script>document.write(numberWithCommas(topStream.streams[4].viewers));</script></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td><script>document.write(topStream.streams[5].channel.display_name);</script></td>
                                <td><script>document.write(numberWithCommas(topStream.streams[5].viewers));</script></td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td><script>document.write(topStream.streams[6].channel.display_name);</script></td>
                                <td><script>document.write(numberWithCommas(topStream.streams[6].viewers));</script></td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td><script>document.write(topStream.streams[7].channel.display_name);</script></td>
                                <td><script>document.write(numberWithCommas(topStream.streams[7].viewers));</script></td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td><script>document.write(topStream.streams[8].channel.display_name);</script></td>
                                <td><script>document.write(numberWithCommas(topStream.streams[8].viewers));</script></td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td><script>document.write(topStream.streams[9].channel.display_name);</script></td>
                                <td><script>document.write(numberWithCommas(topStream.streams[9].viewers));</script></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <footer>
            <div class="row">
                <div class="col-lg-12">

                    <ul class="list-inline">
                        <!--<li class="pull-right"><a href="#top">Back to top</a></li>-->
                        <li><a href="http://twitch.tv">Twitch</a></li>
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

<?php
session_start();

if(isset($_POST['submit']))
{
	try
	{
		$conn = new MongoClient();
		$db = $conn->test;
		$collection = $db->items;
		$user = array('username' => $_POST['user'],
			'password' => $_POST['pass'],
			'firstName' => $_POST['first'],
			'lastName' => $_POST['last']);

		$collection->insert($user);

		$_SESSION['username'] = $_POST['user'];
		$_SESSION['password'] = $_POST['pass'];
		$_SESSION['firstName'] = $_POST['first'];
		$_SESSION['lastName'] = $_POST['last'];

		$conn->close();
	}
	catch(MongoConnectionException $e){ die('Error connecting to MongoDB server'); }
	catch(MongoException $e){ die('Error: ' . $e->getMessage()); }
}
?>
    <!DOCTYPE HTML>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="apple-touch-icon" sizes="57x57" href="../images/twitchicon.ico/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="../images/twitchicon.ico/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="../images/twitchicon.ico/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="../images/twitchicon.ico/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="../images/twitchicon.ico/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="../images/twitchicon.ico/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="../images/twitchicon.ico/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="../images/twitchicon.ico/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="../images/twitchicon.ico/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192" href="../images/twitchicon.ico/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../images/twitchicon.ico/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="../images/twitchicon.ico/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../images/twitchicon.ico/favicon-16x16.png">
        <link rel="manifest" href="../images/twitchicon.ico/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="../images/twitchicon.ico/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
        <title>TwitchDen</title>
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
                    <a href="../index.php" class="navbar-brand">TwitchDen</a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-main">
                    <ul class="nav navbar-nav">
                        <li><a href="">Games</a></li>
                        <li><a href="">Channels</a></li>
                        <li><a href="../about.php">About</a></li>
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

        <div class="bs-docs-section">
            <div class="wrapper">
                <div class="col-lg-12">
                    <div class="page-header">
                        <h1 id="forms">
                    <?php
                    if(isset($_SESSION['username']))
                        echo "Welcome to the site " . $user['firstName'] . " " . $user['lastName'] . "!";
                    else
                        echo "Unable to create account.";
                    ?>
				</h1>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <div class="row">
                <div class="col-lg-12">

                    <ul class="list-inline">
                        <li class="pull-right"><a href="#top">Back to top</a></li>
                        <li><a href="https://twitter.com/peruginim">Twitter</a></li>
                        <li><a href="https://github.com/peruginim">GitHub</a></li>
                        <li><a href="https://github.com/justintv/Twitch-API">API</a></li>
                    </ul>
                    <p>Made by <a href="" rel="nofollow">Michael Perugini</a>. Contact him at <a href="">11peruginiM@gmail.com.</p>
            <p>Based on <a href="http://getbootstrap.com" rel="nofollow">Bootstrap</a>. Icons from <a href="http://fortawesome.github.io/Font-Awesome/" rel="nofollow">Font Awesome</a>. Web fonts from <a href="http://www.google.com/webfonts" rel="nofollow">Google</a>.</p>

                </div>
            </div>
        </footer>
        </div>
    </body>
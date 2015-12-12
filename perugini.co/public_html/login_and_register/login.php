<?PHP
session_start();
$_SESSION['username'];
$_SESSION['password'];
$_SESSION['firstName'];
$_SESSION['lastName'];
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">
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
    <link rel="icon" type="image/png" sizes="192x192"  href="../images/twitchicon.ico/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../images/twitchicon.ico/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="../images/twitchicon.ico/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/twitchicon.ico/favicon-16x16.png">
    <link rel="manifest" href="../images/twitchicon.ico/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="../images/twitchicon.ico/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
<title>Login</title>
</head>
<body>
<div class="container">
<div class="navbar navbar-default navbar-fixed-top">
  <div class="container">
	<div class="navbar-header">
	  <a href="../index.php" class="navbar-brand">TwitchDen</a>
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
	echo "<li><a href=\"logout.php\">Logout</a>";
}
else
{
	echo "<a href=\"login.php\">Login/Register</a>";
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
<div class="bs-docs-section">
  <div class="wrapper">
	<div class="col-lg-12">
      <div class="page-header">
		<h1 id="forms">Login</h1>
	  </div>
	</div>
  </div>
<div class="wrapper">
<div class="col-lg-6">
<div class="well bs-component">
<form method="POST" class="form-horizontal" ACTION="result.php">
  <fieldset>
	<legend>Enter Username/Password</legend>
	<div class="form-group">
	  <label for="inputUsername" class="col-lg-2 control-label">Username</label>
	  <div class="col-lg-10">
		<input name="user" type="text" class="form-control" id="inputUsername" placeholder="User">
	  </div>
	</div>
	<div class="form-group">
	  <label for="inputPassword" class="col-lg-2 control-label">Password</label>
	  <div class="col-lg-10">
		<input name="pass" type="password" class="form-control" id="inputPassword" placeholder="Password">
	  </div>
	</div>
	<div class="form-group">
	  <div class="col-lg-10 col-lg-offset-2">
		<button name="login" value="Log-In" type="login" class="btn btn-primary">Login</button>
		<form><input type="button" value="Cancel" onClick="window.location.href='../MovieDB.php'" class="btn btn-default"></form>
	  </div>
	</div>
  </fieldset>
</form>
</div>
</div>
</div>
</div>
<div class="wrapper">
	<div class="bs-component">
		<div class="jumbotron">
			</br>
			</br>
			</br>
			</br>
			</br>
			<h1>Register</h1>
			<p>If you have never registered a username, please do so by clicking the register button!</p>
			<p><a href="register.php" class="btn btn-primary btn-lg">Register</a></p>
		</div>
	</div>
</div>
</div>
</body>

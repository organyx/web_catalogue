<?php require_once('Connections/WebCatalogue.php'); ?>
<?php require_once('Helpers/security.php'); ?>

<!doctype html>
<html>
<head>

<link href="CSS/Layout.css" rel="stylesheet" type="text/css">
<link href="CSS/Menu.css" rel="stylesheet" type="text/css">

<meta charset="utf-8">
<title>Forgot Password</title>
</head>

<body>
<div id="Holder">
  <div id="Header"></div>
  <div id="NavBar">
    	<nav>
        	<ul>
                <li><a href="Index.php">Main</a></li>
                <li><a href="Register.php">Register</a></li>
                <li><a href="ForgotPassword.php">Forgot Password</a></li>
            </ul>
            
                  
              <div id="log">
            <?php include "log.php" ?>
            </div>
                 
    </nav>
  </div>
  <div id="Content">
    	<div id="PageHeading">
    	  <h1>Forgot Password</h1>
   	  </div>
    	<div id="contentLeft">
    	  
    	  <h6>Type in your email <br>to recieve your password</h6>
    	</div>
    <div id="contentRight">
      <?php include "PHP/forgotpass.php"?>
    </div>
  </div>
  <div id="Footer">
  </div>
</div>
</body>
</html>
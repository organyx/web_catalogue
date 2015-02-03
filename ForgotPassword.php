<!doctype html>
<html>
<head>
<link href="CSS/Layout.css" rel="stylesheet" type="text/css">
<link href="CSS/Menu.css" rel="stylesheet" type="text/css">
<style type="text/css">
h1,h2,h3,h4,h5,h6 {
	font-weight: lighter;
}
</style>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<div id="Holder">
  <div id="Header"></div>
  <div id="NavBar">
    	<nav>
        	<ul>
            	<li><a href="Login.php">Login</a></li>
                <li><a href="Register.php">Register</a></li>
                <li><a href="Index.php">Main</a></li>
                <li><a href="ForgotPassword.php">Forgot Password</a></li>
                
            </ul>
        </nav>
  </div>
  <div id="Content">
    	<div id="PageHeading">
    	  <h1>Forgot Password</h1>
   	  </div>
    	<div id="contentLeft">
    	  <h2>&nbsp;</h2><br>
    	  <h6>Type in your email to recieve your password</h6>
    	</div>
    <div id="contentRight">
      <form action="EMPW-Script.php" method="post" name="EMPWForm" id="EMPWForm">
        <label for="EMPWEmail"><h6>Email:</h6><br></label>
        <input name="EMPWEmail" type="text" class="StyleTextField" id="EMPWEmail">
        <input type="submit" name="EMPWButton" id="EMPWButton" value="Email Password">
      </form>
    </div>
  </div>
  <div id="Footer"><p><a href="Admin.php">Admin</a></p></div>
</div>
</body>
</html>
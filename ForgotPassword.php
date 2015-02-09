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
    	  
    	  <h6>Type in your email <br>to recieve your password</h6>
    	</div>
    <div id="contentRight">
      <form action="Helpers/EMPW-Script.php" method="post" name="EMPWForm" id="EMPWForm"> 
      <table class="center TableStyleAccount WidthAuto">
      <tr><td>&nbsp;</td></tr>
        <tr>
          <td> <label for="EMPWEmail"><h6>Email:</h6><br></label>
        		<input name="EMPWEmail" type="text" class="styletxtfield" id="EMPWEmail"></td>
        </tr>
        <tr>
          <td><input type="submit" name="EMPWButton" id="EMPWButton" value="Email Password"></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
      </form>
    </div>
  </div>
  <div id="Footer"><p><a href="Admin.php">Admin</a></p></div>
</div>
</body>
</html>
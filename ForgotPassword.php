<?php require_once('Connections/WebCatalogue.php'); ?>
<?php require_once('Helpers/security.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['Email'])) {
  $loginUsername=$_POST['Email'];
  $password=$_POST['Password'];
$enc_pass = aes_encrypt($_POST['Password']);
  $password=base64_encode($enc_pass);
  $MM_fldUserAuthorization = "userID";
  $MM_redirectLoginSuccess = "Account.php";
  $MM_redirectLoginFailed = "Index.php";
  $MM_redirecttoReferrer = true;
  mysql_select_db($database_WebCatalogue, $WebCatalogue);
  	
  $LoginRS__query=sprintf("SELECT email, password, userID FROM users WHERE email=%s AND password=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $WebCatalogue) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'userID');
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && true) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
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
            
                  
              <?php if(!isset($_SESSION['MM_Username'])) {?>
                  <form ACTION="<?php echo $loginFormAction; ?>" id="LoginForm" name="LoginForm" method="POST">
                  <table width="300" align="right">
                    <tr>
                      <td align="right"><label for="Email">Email:</label>
                      <input type="text" name="Email" id="Email"></td>
                      <td width="50" rowspan="2"><input type="submit" name="submit" id="submit" value="Submit"></td>
                    </tr>
                    <tr>
                      <td style="text-align: right"><label for="Password" style="text-align: left">Password:</label>
                      <input type="password" name="Password" id="Password"></td>
                    </tr>
                  </table>
                  </form>
                  <?php } else { ?>
                  <table width="300" align="right">
                    <tr>
                      <td align="right"><label>User: <?php echo $_SESSION['MM_Username']; ?></label></td>
                      <td align="right"><a class="link" href="LogOut.php">LogOut</a></td>
                    </tr>
                  </table>
                  
                  <?php }  ?>
                 
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
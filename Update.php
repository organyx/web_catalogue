<?php @session_start(); ?>
<?php require_once('Connections/WebCatalogue.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "1";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "Login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "UpdateForm")) {
  $updateSQL = sprintf("UPDATE users SET password=%s, language=%s, url=%s, title=%s, `description`=%s WHERE userID=%s",
                       GetSQLValueString($_POST['Password'], "text"),
					   GetSQLValueString($_POST['Language'], "text"),
                       GetSQLValueString($_POST['URL'], "text"),
                       GetSQLValueString($_POST['Title'], "text"),
                       GetSQLValueString($_POST['Description'], "text"),
                       GetSQLValueString($_POST['UserIDhiddenField'], "int"));

  mysql_select_db($database_WebCatalogue, $WebCatalogue);
  $Result1 = mysql_query($updateSQL, $WebCatalogue) or die(mysql_error());

  $updateGoTo = "Account.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_User = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_User = $_SESSION['MM_Username'];
}
mysql_select_db($database_WebCatalogue, $WebCatalogue);
$query_User = sprintf("SELECT * FROM users WHERE email = %s", GetSQLValueString($colname_User, "text"));
$User = mysql_query($query_User, $WebCatalogue) or die(mysql_error());
$row_User = mysql_fetch_assoc($User);
$totalRows_User = mysql_num_rows($User);

mysql_select_db($database_WebCatalogue, $WebCatalogue);
$query_ManageUsers = "SELECT * FROM users ORDER BY registration DESC";
$ManageUsers = mysql_query($query_ManageUsers, $WebCatalogue) or die(mysql_error());
$row_ManageUsers = mysql_fetch_assoc($ManageUsers);
$totalRows_ManageUsers = mysql_num_rows($ManageUsers);
?>
<!doctype html>
<html>
<head>
<link href="CSS/Layout.css" rel="stylesheet" type="text/css">
<link href="CSS/Menu.css" rel="stylesheet" type="text/css">

<meta charset="utf-8">
<title>Update Account</title>
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
    	  <h1>Welcome,  <?php echo $row_User['first_name']; ?> <?php echo $row_User['last_name']; ?>!</h1>
      </div>
    	<div id="contentLeft">
    	  <h2>Your Message</h2><br>
          <h2><a href="Account.php">My Account</a></h2><br>
    	  <h2><a href="Update.php">Update Account</a></h2><br>
    	  <h2><a href="LogOut.php">Log Out</a></h2><br>
    	  <br>
    	  <h6>Your message</h6>
    	</div>
    <div id="contentRight">
      <table width="630" border="0" align="center">
        <tr>
          <td>Account: <?php echo $row_User['email']; ?></td>
        </tr>
        <tr>
          <td><form action="<?php echo $editFormAction; ?>" id="UpdateForm" name="UpdateForm" method="POST"><table width="400" border="0" align="center">
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><table border="0">
                <tr>
                  <td><label for="Password">Password:</label><br><br>
                    <input name="Password" type="password" class="styletxtfield" id="Password" value="<?php echo $row_User['password']; ?>"></td>
                  <td><label for="PasswordConfirm">Confirm Password:</label><br><br>
                    <input name="PasswordConfirm" type="password" class="styletxtfield" id="PasswordConfirm" value="<?php echo $row_User['password']; ?>"></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><label for="Language">Language:</label><br><br>
                <input name="Language" type="text" class="styletxtfield" id="Language" value="<?php echo $row_User['language']; ?>"></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><label for="URL">Url:</label><br><br>
                <input name="URL" type="text" class="styletxtfield" id="URL" value="<?php echo $row_User['url']; ?>"></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><label for="Title">Title:</label><br><br>
                <input name="Title" type="text" class="styletxtfield" id="Title" value="<?php echo $row_User['title']; ?>"></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><label for="Description">Description:</label><br><br>
                <input name="Description" type="text" class="styletxtfield" id="Description" value="<?php echo $row_User['description']; ?>"></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td><input name="UserIDhiddenField" type="hidden" id="UserIDhiddenField" value="<?php echo $row_User['userID']; ?>">                <input type="submit" name="UpdateButton" id="UpdateButton" value="Update Account"></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table>
              <input type="hidden" name="MM_update" value="UpdateForm">
          </form>
            
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
    </div>
  </div>
  <div id="Footer"><p><a href="Admin.php">Admin</a></p></div>
</div>
</body>
</html>
<?php
mysql_free_result($User);

mysql_free_result($ManageUsers);
?>

<?php @session_start(); ?>
<?php require_once('../Connections/WebCatalogue.php'); ?>
<?php require_once('../Helpers/security.php'); ?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "2";
$MM_donotCheckaccess = "false";

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
    if (($strUsers == "") && false) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../Index.php";
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

$colname_User = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_User = $_SESSION['MM_Username'];
}
mysql_select_db($database_WebCatalogue, $WebCatalogue);
$query_User = sprintf("SELECT * FROM `users` WHERE email = %s", GetSQLValueString($colname_User, "text"));
$User = mysql_query($query_User, $WebCatalogue) or die(mysql_error());
$row_User = mysql_fetch_assoc($User);
$totalRows_User = mysql_num_rows($User);
?>
<!doctype html>
<html>
<head>

<link href="../CSS/Layout.css" rel="stylesheet" type="text/css">
<link href="../CSS/Menu.css" rel="stylesheet" type="text/css">

<meta charset="utf-8">
<title>Admin Control Panel</title>
</head>

<body>
<div id="Holder">
  <div id="Header"></div>
  <div id="NavBar">
    	<nav>
        	<ul>
              <li><a href="../Index.php">Main</a></li>
                <li><a href="../Register.php">Register</a></li>
                <li><a href="../ForgotPassword.php">Forgot Password</a></li>      
          </ul>
            
             <?php if(isset($_SESSION['MM_Username'])) { ?>
              <table width="300" align="right">
                <tr>
                  <td align="right"><label>User: <?php echo $_SESSION['MM_Username']; ?></label></td>
                  <td align="right"><a class="link" href="../LogOut.php">LogOut</a></td>
                </tr>
                <tr>
               		<td></td>
                	<td align="right"><a class="link" href="../Account.php">My Account</a></td>
                </tr>
              </table>
              
              <?php }  ?>
        </nav>
  </div>
  <div id="Content">
    	<div id="PageHeading">
    	  <h1>Admin CP</h1>
   	  </div>
    	<div id="contentLeft">
    	  <h2>Admin links</h2><br>
    	  <h2><a href="../Account.php">My Account</a></h2><br>
          <h2><a href="AdminManageUsers.php" >Manage Users</a></h2>
    	  <p>&nbsp;</p>
    	  <br>
    	  <h6>links</h6>
    	</div>
    <div id="contentRight"></div>
  </div>
  <div id="Footer">

    	<p><a href="Admin.php">Admin</a></p>

  </div>
</div>
</body>
</html>
<?php
mysql_free_result($User);
?>
<?php @session_start(); ?>
<?php require_once('Connections/WebCatalogue.php'); ?>
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

$currentPage = $_SERVER["PHP_SELF"];

$colname_User = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_User = $_SESSION['MM_Username'];
}
mysql_select_db($database_WebCatalogue, $WebCatalogue);
$query_User = sprintf("SELECT * FROM `users` WHERE email = %s", GetSQLValueString($colname_User, "text"));
$User = mysql_query($query_User, $WebCatalogue) or die(mysql_error());
$row_User = mysql_fetch_assoc($User);
$totalRows_User = mysql_num_rows($User);

$maxRows_ManageUsers = 10;
$pageNum_ManageUsers = 0;
if (isset($_GET['pageNum_ManageUsers'])) {
  $pageNum_ManageUsers = $_GET['pageNum_ManageUsers'];
}
$startRow_ManageUsers = $pageNum_ManageUsers * $maxRows_ManageUsers;

mysql_select_db($database_WebCatalogue, $WebCatalogue);
$query_ManageUsers = "SELECT * FROM `users` WHERE NOT `approval` = '0000-00-00 00:00:00' ORDER BY registration DESC";
$query_limit_ManageUsers = sprintf("%s LIMIT %d, %d", $query_ManageUsers, $startRow_ManageUsers, $maxRows_ManageUsers);
$ManageUsers = mysql_query($query_limit_ManageUsers, $WebCatalogue) or die(mysql_error());
$row_ManageUsers = mysql_fetch_assoc($ManageUsers);

if (isset($_GET['totalRows_ManageUsers'])) {
  $totalRows_ManageUsers = $_GET['totalRows_ManageUsers'];
} else {
  $all_ManageUsers = mysql_query($query_ManageUsers);
  $totalRows_ManageUsers = mysql_num_rows($all_ManageUsers);
}
$totalPages_ManageUsers = ceil($totalRows_ManageUsers/$maxRows_ManageUsers)-1;

$queryString_ManageUsers = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_ManageUsers") == false && 
        stristr($param, "totalRows_ManageUsers") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_ManageUsers = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_ManageUsers = sprintf("&totalRows_ManageUsers=%d%s", $totalRows_ManageUsers, $queryString_ManageUsers);
?>
<!doctype html>
<html><head>

<link href="CSS/Layout.css" rel="stylesheet" type="text/css">
<link href="CSS/Menu.css" rel="stylesheet" type="text/css">
<script src="Javascript/jquery-2.1.3.min.js" type="text/javascript"></script>

<!-- Add fancyBox -->
<link rel="stylesheet" href="fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>

<!-- Optionally add helpers - button, thumbnail and/or media -->
<link rel="stylesheet" href="fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

<link rel="stylesheet" href="fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>	
<!-- Pop Up -->
<script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox();
	});
</script>				

<meta charset="utf-8">
<title>Main</title>
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
    	  <h1>Main</h1>
      </div>
    	<div id="contentLeft">
    	  <h2><a href="Account.php">Account</a></h2>
			<br>
    	  <h6>links</h6>
    	</div>
    <div id="contentRight">
      <table class="TableStyleBig"  align="center">
        <tr>
          <td align="right" valign="top">Showing:&nbsp;<?php echo ($startRow_ManageUsers + 1) ?> to <?php echo min($startRow_ManageUsers + $maxRows_ManageUsers, $totalRows_ManageUsers) ?> of <?php echo $totalRows_ManageUsers ?></td>
        </tr>
        <tr>
          <td align="center" valign="top"><?php if ($totalRows_ManageUsers > 0) { // Show if recordset not empty ?>
            <?php do { ?>
                <table border="1" class="TableStyleIndex">
                
                  <tr>
                    <td width="400" height="33" align="center"><?php echo $row_ManageUsers['title']; ?></td>
                     <td width="150" height="50" rowspan="3">
                     <a class="fancybox"  href="<?php echo $row_ManageUsers['preview_thumb']; ?>">
                     <img src="<?php echo $row_ManageUsers['preview_thumb']; ?>" alt="" height="140px" width="140px" class="img-thumbnail"/></a>
                     </td>
                  </tr>
                  <tr>
                    <td width="400" height="33">
                    <table border="0">
                      <tr>
                        <td width="210" height="30" align="center"><a href="<?php echo $row_ManageUsers['url']; ?>"><?php echo $row_ManageUsers['url']; ?></a></td>
                        <td width="210" height="30" align="center">Language: <?php echo $row_ManageUsers['language']; ?></td>
                      </tr>
                    </table><a href="<?php echo $row_ManageUsers['url']; ?>"></a></td>
                  </tr>
                  <tr>
                    <td width="400" height="64" valign="top"><?php echo $row_ManageUsers['description']; ?></td>
                  </tr>
                </table><br>
                <?php } while ($row_ManageUsers = mysql_fetch_assoc($ManageUsers)); ?>
          <?php } // Show if recordset not empty ?></td>
        </tr>
        <tr>
          <td align="right" valign="top"><?php if ($pageNum_ManageUsers < $totalPages_ManageUsers) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_ManageUsers=%d%s", $currentPage, min($totalPages_ManageUsers, $pageNum_ManageUsers + 1), $queryString_ManageUsers); ?>">Next</a>
              <?php } // Show if not last page ?>
|
<?php if ($pageNum_ManageUsers > 0) { // Show if not first page ?>
  <a href="<?php printf("%s?pageNum_ManageUsers=%d%s", $currentPage, max(0, $pageNum_ManageUsers - 1), $queryString_ManageUsers); ?>">Previous</a>
  <?php } // Show if not first page ?>          </td>
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

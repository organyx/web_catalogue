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
    
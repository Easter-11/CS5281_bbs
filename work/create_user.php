<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE"); 
header("Content-type: text/html; charset=utf-8"); 
  /**************************************/
  /*		文件名：create_user.php		*/
  /*		功能：生成用户注册页面		*/
  /**************************************/

  require('../config.inc.php');
  include('../includes/header.inc.php');
?>
<div class="createUser">
<h2>Register</h2>

<fieldset style="background:url(../images/header-background2.png) left" >
<legend>Register</legend>
<form id="Register" method="post" action="add_user.php">
<table width="850" >
  <tr>
	<td width="100" ><label for="username">Username:</label></td>
	<td><input name="username" type="text"></td>
    <td width="400"><p class="msg"><i class="ati"></i>Please enter 6-26 characters</p></td>
  </tr>
  <tr>
    <td width="100"><label for="password">Password:</label></td>
    <td><input name="password" type="password"></td>
      <td width="400"><p class="msg">Password length should not exceed 16 characters, using a combination of letters, numbers, etc</p></td>
  </tr>
  <tr>
    <td width="150"><label for="password">Confirm Password:</label></td>
    <td><input name="password" type="password" disabled=""></td>
      <td width="400"><p class="msg">The two passwords should be the same</p></td>
  </tr>
  <tr>
    <td width="100"><label for="email">E-mail:</label></td>
    <td><input name="email" type="text"></td>
      <td width="400"><p class="msg"><i class="ati"></i>Please enter 6-26 characters</p></td>
  </tr>
  <tr>
    <td width="100"><label for="realname">Realname:</label></td>
    <td><input name="realname" type="text"></td>
      <td width="400"><p class="msg"Realname should be unique</p></td>
  </tr>
</table>
<section class="button">
<input type="submit" name="Submit" value="Submit" class="button"/>
<input type="reset" name="Submit2" value="Clear" class="button"/>
</section>
</form>
</fieldset>
</div>
<?php 

	//公用尾部页面
	include('../includes/footerRegis.inc.php');
?>

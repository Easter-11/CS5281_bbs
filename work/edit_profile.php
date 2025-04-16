<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE"); 
header("Content-type: text/html; charset=utf-8"); 
  /******************************************/
  /*		文件名：edit_profile.php		*/
  /*		功能：用户资料修改页面		    */
  /******************************************/

  require('../config.inc.php');

  //用户名
  $id = $_SESSION['username'];

  //如果用户没有登录
  if (!$_SESSION['username']) {
	ExitMessage("Please <b>log in</b> to execute this request。", "logon_form.php");
  }
?>

<?php include('../includes/header.inc.php'); ?>
<div class="editUser">

<h2>Edit Profile</h2>

<?php
  //查询用户资料
  $sql="SELECT * FROM forum_user WHERE username = '$id'";
  $result=$mysqli->query($sql);
  $rows=$result->fetch_array();
?>

<fieldset>
	<legend>Profile</legend>
<form method="ost" action="update_profile.php">

<table>
  <tr>
    <td>Login User：</td>
    <td><b><? echo $rows['username']; ?></b></td>
  </tr>
  <tr>
	<td>Update Password:</td><td><input name="password" type="password"> Leave the password blank and will not be updated.</td>
  </tr>
  <tr>
	<td>email:</td>
	<td><input name="email" type="text"
			value="<?php echo $rows['email']; ?>"></td>
  </tr>
  <tr>
	<td>realname:</td>
	<td><input name="realname" type="text"
			 value="<?php echo $rows['realname']; ?>"></td>
  </tr>
</table>
<br><br>
<section class="button">
<input type="submit" name="submit" value="submit" class="button"> 
</section>
</form>
</fieldset>
</div>	
<?php include('../includes/footer.inc.php'); ?>

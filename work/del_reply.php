<?php
ini_set("error_reporting", "E_ALL & ~E_NOTICE");
header("Content-type: text/html; charset=utf-8");

require('../config.inc.php');

// 判断是否登录并是管理员
if (!isset($_SESSION['username']) || $_SESSION['username'] != ADMIN_USER) {
  ExitMessage("Permission denied.", "main_forum.php");
}

// 获取 reply_id 和 topic_id
$reply_id = intval($_POST['reply_id']);
$topic_id = intval($_POST['topic_id']);

// 删除评论
$sql = "DELETE FROM forum_reply WHERE reply_id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $reply_id);
$stmt->execute();

// 返回到帖子页面
header("Location: view_topic.php?id=$topic_id");
exit();
?>

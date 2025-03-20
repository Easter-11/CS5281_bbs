<?php
header("Content-type: text/html; charset=utf-8"); 

/*******************/
/*  系统参数设置   */
/*******************/

// 数据库配置
define('DB_USER', "root");    
define('DB_PASSWORD', "root"); 
define('DB_HOST', "localhost"); 
define('DB_NAME', "flowerbbs");    

// 管理员用户
define('ADMIN_USER', "admin");

// 分页设置，每页最多显示的记录数
define('EACH_PAGE', 5);

// 连接数据库
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// 检查连接是否成功
if ($mysqli->connect_error) {
    die("<b>数据库连接失败：</b> " . $mysqli->connect_error);
} else {
    // echo "✅ 数据库连接成功！"; // 这里输出连接成功的消息
}

/*******************/
/*  公共函数设置   */
/*******************/

// 检查电子邮件地址格式
function CheckEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// 显示错误信息并终止程序
function ExitMessage($message, $url = '')
{
    echo '<p class="message">' . htmlspecialchars($message) . '<br>';
    echo $url ? '<a href="' . htmlspecialchars($url) . '">返回</a>' : '<a href="create_user.php">返回</a>';
    echo '</p>';
    exit;
}

// 清除特殊字符（防止 SQL 注入）
function ClearSpecialChars($str)
{
    return htmlspecialchars(trim($str), ENT_QUOTES, 'UTF-8');
}

// 开启 SESSION
session_start();
?>

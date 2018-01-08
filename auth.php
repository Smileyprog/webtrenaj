<?php
// Страница авторизации

// Функция для генерации случайной строки
function generateCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];
    }
    return $code;
}

// Соединямся с БД
$link=mysqli_connect("localhost", "root", "", "webWithGoogle");



if(isset($_POST['submit']))
{


    // Вытаскиваем из БД запись, у которой логин равняеться введенному
    $query = mysqli_query($link,"SELECT user_id, user_password FROM users WHERE user_login='".mysqli_real_escape_string($link,$_POST['login'])."' LIMIT 1");
    $data = mysqli_fetch_assoc($query);


    // Сравниваем пароли
    if($data['user_password'] === md5(md5($_POST['password'])))  {
        // Генерируем случайное число и шифруем его
        $hash = md5(generateCode(10));
        //echo ($hash);

        if($_POST['ip'] == '1')
        {
            // Если пользователя выбрал привязку к IP
            // Переводим IP в строку
            $insip = ", user_ip=INET_ATON('".$_SERVER['REMOTE_ADDR']."')";
        }

        // Записываем в БД новый хеш авторизации и IP
        mysqli_query($link, "UPDATE users SET user_hash='".$hash."' ".$insip." WHERE user_id='".$data['user_id']."'");

        // Ставим куки
        setcookie("id", $data['user_id'], time()+60*60*24*30);
        setcookie("hash", $hash, time()+60*60*24*30,null,null,null,true); // httponly !!!

        // Переадресовываем браузер на страницу проверки нашего скрипта
        header("Location: index.php"); exit();
    }
    else
    {
       echo 'Вы ввели неправильный логин/пароль';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> -->
    <title>Авторизация</title>
	<link rel="stylesheet" type="text/css" href="mainstyles/authstyle.css"> <!-- Авторизация -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
</head>
<body>





<style type="text/css">
    
.center {
    text-align: center;
    color: red;
    font-family: 'Roboto';


}

</style>


<div id="wrapper">
    <div class="user-icon"></div>
    <div class="pass-icon"></div>
	
<form name="login-form" class="login-form" method="post">

    <div class="header">
		<h1>Авторизация</h1>
		<span>Пожалуйста, введите Ваш логин и пароль </span>
    </div>

    <div class="content">
		<input name="login"  id="xuu"  type="text"     class="input username" value="Логин" onfocus="this.value=''" />
		<input name="password"  type="password" class="input password" value="Пароль" onfocus="this.value=''" />
    </div>

    <div class="footer">
		<input type="submit" name="submit" value="ВОЙТИ" class="button"/>
		<span class="remember"><img id="okicon" src="images/notok.png" width="30"></span><span id="remember" class="register">Привязать к IP?</span>
		<input type="hidden" name="auth">
        <input type="hidden" id="ip" name="ip" value="0">

    </div>
    <div id="incorrect" class="center">
</div>
</form>
</div>
<div class="gradient"></div>

<script type="text/javascript">





var state = 0

$(document).ready(function() {
	$(".username").focus(function() {
		$(".user-icon").css("left","-48px");
	});
	$(".username").blur(function() {
		$(".user-icon").css("left","0px");
	});
	
	$(".password").focus(function() {
		$(".pass-icon").css("left","-48px");
	});
	$(".password").blur(function() {
		$(".pass-icon").css("left","0px");
	});
});

$('#remember').click(function(){

if (window.state == 0) {

	$('.remember').fadeOut(300, function() {
	$('#okicon').attr('src','images/ok.png')
	window.state = 1;
    $('#ip').val('1')
	$('.remember').fadeIn(300)
})
	}

else if (window.state == 0) {

	$('.remember').fadeOut(300, function() {
	$('#okicon').attr('src','images/notok.png')
	window.state = 0;
    $('#ip').val('0')
	$('.remember').fadeIn(300)
})
}

})




</script>
</body>
</html>
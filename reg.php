<?php
// ПРОВЕРКА
$link=mysqli_connect("localhost", "root", "", "webWithGoogle");

if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) {
  $query = mysqli_query($link, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
  $userdata = mysqli_fetch_assoc($query);
  $rights = $userdata['rights'];

  if(($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id'])) {
    setcookie("id", "", time() - 3600*24*30*12, "/");
    setcookie("hash", "", time() - 3600*24*30*12, "/");
    echo 'У вас нет доступа к этой странице';
    return;
  } 
  else
  {
      if ($rights != 1){
        echo 'У вас нет доступа к этой странице';
        return;
      }
  }
}
else
{
  echo 'У вас нет доступа к этой странице';
  return;
}




// РЕГИСТРАЦИЯ
$link=mysqli_connect("localhost", "root", "", "webWithGoogle");

if(isset($_POST['submit']))
{
    $err = [];

    // проверям логин
    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
    {
        $err[] = "Логин может состоять только из букв английского алфавита и цифр";
    }

    if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)
    {
        $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
    }

    // проверяем, не сущестует ли пользователя с таким именем
    $query = mysqli_query($link, "SELECT user_id FROM users WHERE user_login='".mysqli_real_escape_string($link, $_POST['login'])."'");
    if(mysqli_num_rows($query) > 0)
    {
        $err[] = "Пользователь с таким логином уже существует в базе данных";
    }

    // Если нет ошибок, то добавляем в БД нового пользователя
    if(count($err) == 0)
    {

        $login = $_POST['login'];
        $fio = $_POST['fio'];
        $email = $_POST['email'];
        $tel1 = $_POST['tel1'];
        $tel2 = $_POST['tel2'];
        $rights = $_POST['rights'];

        // Убераем лишние пробелы и делаем двойное шифрование
        $password = md5(md5(trim($_POST['password'])));

        mysqli_query($link,"INSERT INTO users SET user_login='".$login."', user_password='".$password."', email='".$email."', fio='".$fio."', tel1='".$tel1."', tel2='".$tel2."', rights='".$rights."'");
        header("Location: index.php"); exit();
    }
    else
    {
        print "<b>При регистрации произошли следующие ошибки:</b><br>";
        foreach($err AS $error)
        {
            print $error."<br>";
        }
    }
}
?>

<!DOCTYPE HTML>

<html>
<head>
</head>
<body>
    

<style>

.main {

    
    margin: 200px auto auto auto;
    height: 500px;
    width: 600px;
    text-align: center;
    padding: 10px;
    border: 2px solid grey;
    font-family: "ROBOTO";
    font-size: 16px;

}

input {
border-radius: 5px;
    
}

td {

    padding:15px 20px;
}

.sub {

    margin-top:30px;
    text-align: center;


}

table {
margin:auto;

}

#submitt {

padding: 20px 20px;
font-family: "ROBOTO";
font-weight: bold;
font-size: 16px;

}

.back {

position:absolute;
left:5;
top:5;
border-right: 1px solid grey;
border-bottom: 1px solid grey;
padding-bottom: 5px;
padding-right:5px;
font-weight: bold;
}

.back:hover {

cursor:pointer;

}



</style>


<div class="main">
<div class="back">
    <span onclick="goBack()">Назад</span>
</div>
<form method="POST">
        <table>
        <tr>
    <td>Логин</td>
    <td><input name="login" type="text"></td>
    </tr>
    <tr>
    <td>Пароль</td> 
    <td><input name="password" type="password"></td>
    </tr>
    <tr>
    <td>Фио</td> 
    <td><input name="fio" type="text"></td>
    </tr>
    <tr>
    <td>Email</td> 
    <td><input name="email" type="text"></td>
    </tr>
    <tr>
    <td>Телефон 1</td> 
    <td><input name="tel1" type="text"></td>
    </tr>
    <tr>
    <td>Телефон 2</td> 
    <td><input name="tel2" type="text"></td>
    </tr>
    <tr>
    <td>Доп. права?</td> 
    <td><input type="radio" name="rights" value="0">Нет <input type="radio" name="rights" value="1">Да</td>
    </tr>
    </table>


    <div class="sub">
        <input name="submit" id="submitt" type="submit" value="Зарегистрировать">
</div>
    </form>
    </div>

<script>

function goBack() {

    window.location.pathname = '/admin'

}


</script>


    </body>
    </html>
<?php

if(isset($_POST['manData'])) {

  $name = urldecode($_POST['manData']);

$link=mysqli_connect("localhost", "root", "", "webWithGoogle");


  $query = mysqli_query($link, "SELECT * FROM users WHERE fio = '$name' LIMIT 1");
  $userdata = mysqli_fetch_assoc($query);

    // ЗАПРОС МЕНЕДЖЕРСКИХ ДАННЫХ

      $manFio = $userdata['fio'];
      $manEmail = $userdata['email'];
      $manTel1 = $userdata['tel1'];
      $manTel2 = $userdata['tel2'];
      

       $arr = array('fio'=>$manFio, 'email'=>$manEmail, 'tel1'=>$manTel1, 'tel2'=>$manTel2);

       echo json_encode($arr);



      // !ЗАПРОС МЕНЕДЖЕРСКИХ ДАННЫХ!
}

?>
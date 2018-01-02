<?
  if(isset($_POST['data'])){
  //header('Content-Type: text/plain');

  $curl = curl_init();
  // Set some options
  curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://script.google.com/macros/s/AKfycbyqkkIeVqADK9etQpXQJXH6J2vG-2jdy2sz6Gxd_ss0ybhcouR6/exec',
  CURLOPT_POST => 1,
  CURLOPT_POSTFIELDS => $_POST['data'],
  CURLOPT_FOLLOWLOCATION => 1
  ));                                                          
   $result = curl_exec($curl);
   echo $result;
}
   ?>
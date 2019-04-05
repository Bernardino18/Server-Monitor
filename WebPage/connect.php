<?php
 /*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
$ip = $_POST['ip'];
$command = isset($_POST['command']) ? $_POST['command'] : '';

$socket = stream_socket_client('tcp://'. $ip.':11000',$errno, $errstr, 5);
if ($socket) {
  if($command != "") {
    fwrite($socket,$command);
  }else {
    fwrite($socket, "GET DATA:.");  //shutdown -s -t 0
  }
  $server_response = fread($socket, 1024);
  $msg = $server_response;
  fclose($socket);
} else {
    $msg = "";

}
echo $msg;  

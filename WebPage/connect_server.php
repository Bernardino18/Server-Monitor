<?php
$socket = stream_socket_client('tcp://127.0.0.1:12300',$errno, $errstr, 5);
if ($socket) {
  $server_response = fread($socket, 1024);
  $msg = $server_response;
  fclose($socket);
} else {
    $msg = 'Unable to connect to server';
}
echo $msg;
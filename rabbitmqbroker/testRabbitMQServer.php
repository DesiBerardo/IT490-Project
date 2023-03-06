#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('rabbitFuncs.php');

function logger($log_msg)
{
  $log_filename = '/var/log/rabbit_log';
  if (!file_exists($log_filename))
  {
      // create directory/folder uploads.
      mkdir($log_filename, 0777, true);
  }
  $log_msg = print_r($log_msg, true);
  $log_file_data = $log_filename.'/log_' . 'rabbit' . '.log';
  file_put_contents($log_file_data, $log_msg . "\n", FILE_APPEND);
}

function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "Login":
      return doLogin($request['username'],$request['password']);
    case "Register":
      //return "this message is false";
    case "validate_session":
      return doValidate($request['sessionId']);
  }
  return array("returnCode" => '0', 'message'=>"Server recieved request and processeed");
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

echo "testRabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END".PHP_EOL;
exit();
?>


#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function doLogin($username,$password)
{
  $mydb = new mysqli('127.0.0.1','root','12345','userdb');

  if ($mydb->errno != 0)
  {
	  echo "failed to connect to database: ". $mydb->error . PHP_EOL;
	  exit(0);
  }

  echo "successfully connected to database".PHP_EOL;

  $query = "select * from users where username=$username;";

  $response = $mydb->query($query);
  if ($mydb->errno != 0)
  {
	  echo "failed to execute query:".PHP_EOL;
	  echo __FILE__.':'.__LINE__.":error: ".$mydb->error.PHP_EOL;
	  exit(0);
  }
  // lookup username in database
  // check password
  if($response['pass']==$password)
  {
    return true;
  }
  //return false if not valid
  return false;  
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
    case "login":
      return doLogin($request['username'],$request['password']);
    case "validate_session":
      return doValidate($request['sessionId']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

echo "testRabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END".PHP_EOL;
exit();
?>

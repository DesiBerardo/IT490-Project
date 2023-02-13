#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function doLogin($username,$password)
{
    // lookup username in database
    $client = new rabbitMQClient("rabbitmqdb.ini","testServer");
    if (isset($argv[1]))
    {
      $msg = $argv[1];
    }
    else
    {
      $msg = "gimmie dat data white boy";
    }
    
    $request = array();
    $request['type'] = "database";
    $request['username'] = $username;
    $request['password'] = $password;
    $request['message'] = $msg;
    $response = $client->send_request($request);
    //$response = $client->publish($request);
    
    echo "client received response: ".PHP_EOL;
    print_r($response);
    echo "\n\n";
    
    //echo $argv[0]." END".PHP_EOL;
    // check password
    if ($response == true)
    {
      echo "Successful login!";
      return true;
    }
    else
    {
      echo "you are a loser LOSER";
      return false;
    }
    //return false if not valid
    echo "how are you here";
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


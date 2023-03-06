#!/usr/bin/php
<?php


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
      echo "Successful login! at " . time() . "\n";
      return true;
    }
    else
    {
      echo "you are a loser LOSER at " . time() . "\n";
      return false;
    }
    //return false if not valid
    echo "how are you here";
}

?>
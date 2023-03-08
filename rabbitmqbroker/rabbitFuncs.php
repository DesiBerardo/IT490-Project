#!/usr/bin/php
<?php

function logger($log_msg)
{
  $log_filename = 'log/rabbit';
  if (!file_exists($log_filename))
  {
      // create directory/folder uploads.
      mkdir($log_filename, 0777, true);
  }
  $log_msg = print_r($log_msg, true);
  $log_file_data = $log_filename.'/log_' . 'rabbit' . '.log';
  file_put_contents($log_file_data, $log_msg . "\n", FILE_APPEND);
}

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
    $request['time'] = time();
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
      logger(time() . ": User: " . $username . " Sucessful Login");
      return true;
    }
    else
    {
      logger(time() . ": User: " . $username . " Login Failed");
      return false;
    }
    //return false if not valid
    echo "how are you here";
}

?>
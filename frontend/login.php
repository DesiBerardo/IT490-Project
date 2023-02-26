<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

if (!isset($_POST))
{
	$msg = "NO POST MESSAGE SET.";
	echo json_encode($msg);
	exit(0);
}
$request = $_POST;
$response = "unsupported request type.";
switch ($request["type"])
{
	case "login":
        $username = $request["uname"] ;
        $password = $request["pword"];
		$response = "login, yeah we can do that. Here is the username: " . $request["uname"];
        $fake_response = 1 ;
        
        $client = new rabbitMQClient("testRabbitMQ.ini","testServer");
        if (isset($argv[1]))
        {
        $msg = $argv[1];
        }
        else
        {
        $msg = "Passing Login Information";
        }

        $request_array = array();
        $request_array['type'] = "Login";
        $request_array['username'] = $username;
        $request_array['password'] = $password;
        $request_array['message'] = $msg;
  
        $response = $client->send_request($request_array);

        if($response){
        //echo("Response : \n".$rmq_response);
        //header("Location: http://www.addy.com/home.php"); 
        }
        else{
            //echo "Unknown user. Try again.";
        }
        
        
	break;
}
echo json_encode($response);
exit(0);

?>
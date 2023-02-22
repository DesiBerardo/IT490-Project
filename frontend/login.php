<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

?>



<?php
if (!isset($_POST))
{
	$msg = "NO POST MESSAGE SET.";
	echo json_encode($msg);
	exit(0);
}
$request = $_POST["type"];
$response = "unsupported request type";
switch ($request["type"])
{
	case "login":
		
        $username = $_POST["uname"] ;
        $password = $_POST["pword"];
        echo ("testing");
        echo ($username);
        echo ($password);
        $client = new rabbitMQClient("testRabbitMQ.ini","testServer");
        if (isset($argv[1]))
        {
        $msg = $argv[1];
        }
        else
        {
        $msg = "Passing Login Information";
        }

        $request = array();
        $request['type'] = "Login";
        $request['username'] = $username;
        $request['password'] = $password;
        $request['message'] = $msg;
        $response = $client->send_request($request);

        if($response){
        echo("Response : \n".$response);
        header("Location: http://www.addy.com/home.php"); 
        }
        else{
            echo "Unknown user. Try again.";
        }
    break;
}
echo json_encode($response);
exit(0);


    

?>





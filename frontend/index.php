<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
?>

<form method="POST">
    <h1>IT 490 Project</h1>
    <div>
        <label for="username">Username</label>
        <input type="text" name="username" required maxlength="12"/>
    </div>
    <div>
        <label for="pw">Password</label>
        <input type="password" id="pw" name="password" required minlength="8" />
    </div>
    <input type="submit" value="Login" name="login" />
</form>

<?php
if(isset($_POST["login"])){ 
    $username = $_POST["username"] ;
    $password = hash('sha256',$_POST["password"]);
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
    $request['type'] = "login";
    $request['username'] = $username;
    $request['password'] = $password;
    $request['message'] = $msg;
    $response = $client->send_request($request);

    if(isset($response)){
    echo($response);
    }
    else{
        echo "Unknown if message delivered.";
    }

}
?>






<?php 
require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

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
    $password = $_POST["password"];

    echo "Welcome ".$username."!";
}


$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('login', false, false, false, false);

$msg = new AMQPMessage($username);
$channel->basic_publish($msg, '', 'login');

echo " [x] Sent the username.\n";

$channel->close();
$connection->close();
?>






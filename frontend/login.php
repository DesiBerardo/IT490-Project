<html>
<body>

<?php
$username = $_POST["username"] ;
$password = $_POST["password"];

echo $username;
echo $password;
?>

<h3> Welcome <?php echo $_POST["name"]; ?> </h3><br>
<h3>Your email address is: <?php echo $_POST["email"]; ?></h3>

</body>
</html>



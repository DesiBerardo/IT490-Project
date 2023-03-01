<?php
//include functions here so we can have it on every page that uses the nav bar
//that way we don't need to include so many other files on each page
//nav will pull in functions and functions will pull in db
require(__DIR__."/../lib/functions.php");
?>
<!DOCTYPE html>

<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #022831;
}

li a {
  display: block;
  color: White;
  text-align: center;
  padding: 10px 28px;
  text-decoration: none;
}

li {
  float: left;
}


li a:hover {
  background-color: #111;
}
</style>
<nav>
    <ul><!--Home will have recommended travel points and events-->
        <li><a href="home.php">Home</a></li>
        <!--Plan a trip. Events, flights, ect-->
        <li><a href="schedule.php">Plan a Outing!</a></li>
        <li><a href="aboutus.php">About us</a></li>
    </ul>
</nav>

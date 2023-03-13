<?php
require(__DIR__."/nav.php"); 
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$origin = $_GET["origin"] ;
$dest= $_GET["destination"] ;
$cost= $_GET["cost"] ;
$duration= $_GET["duration"] ;
$class= $_GET["class"] ;
$flightArr = json_decode($_GET["array"]);
?>
<link rel="stylesheet" href="styles.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<html>
<script>
</script>

<div id="search-form">
    <div id="header">
      <h1>BOOK YOUR TRIP AND BE ONE STEP CLOSER TO RELAXING!</h1>
    </div>
    <section>
      <div class="flight" id="flightbox">
        
        <form id="booking-form" type="POST">
        
        
        <!-- FROM/TO -->
        <div id="flight-depart">
          <div class="info-box">
            <label for="">Departing City IATA Code</label>
            <input type="text" id="origin" value=<?php echo $origin ?>/>
            <div id="depart-res"></div>
          </div>
          <div class="info-box" id="arrive-box">
            <label for="">Arriving City IATA Code</label>
            <input type="text" id="destination" value=<?php echo $dest ?> />
            <div id="arrive-res"></div>
          </div>
        </div>

        
        <div id="flight-depart">
          <div class="info-box">
            <label for="">Cabin Class</label>
            <input type="text" id="class" value=<?php echo $class ?>/>
            <div id="depart-res"></div>
          </div>
          <div class="info-box" id="arrive-box">
            <label for="">Total Trip Duration</label>
            <input type="text" id="duration" value=<?php echo $duration ?> />
            <div id="arrive-res"></div>
          </div>
        </div>
        
        
        <!-- FROM/TO -->
        <div id="flight-dates" >
          <div class="info-box" >
            <label for="" >Flight Segments</label>

          </div>
          
        </div>
        <div class="info-box" >
            <label for="">Please enter your personal details for booking purposes below.</label>
          </div>

        <!-- PASSENGER INFO -->
        <div id="flight-info">
          <div class="info-box">
            <label for="fname">First Name</label>
            <input type="text" id="fname" min=3/>

            <label for="lname">Last Name</label>
            <input type="text" id="lname" min=3/>

            <label for="dob">Date of Birth</label>
            <input type="date" id="dob" />

            <label for="cell">Cell Phone Number</label>
            <input type="text" id="cell" min=10/>

            <label for="email">Email Address</label>
            <input type="text" id="email" min=5/>

            <label for="adults">Total Number of Passengers</label>
            <select name="adults" id="adults">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select>
            <br> <br>
            <label for="cost">Cost Per Passenger</label>
            <input type="text" id="cost" value=<?php echo $cost ?> />

            
            <div id="flight-depart">
          <div class="info-box">
            <label for="">Credit Card Number</label>
            <input type="text" id="ccnumber"/>
            <div id="depart-res"></div>
          </div>
          <div class="info-box" id="arrive-box">
            <label for="">Expiration Date</label>
            <input type="text" id="expiration" />
            <div id="arrive-res"></div>
          </div>

          </div>
          <div id="flight-depart">
          <div class="info-box">
            <label for="">Cardholder Full Name</label>
            <input type="text" id="ccname"/>
            <div id="depart-res"></div>
          </div>
          <div class="info-box" id="arrive-box">
            <label for="">CVV Code</label>
            <input type="text" id="cvv" />
            <div id="arrive-res"></div>
          </div>
        </div>
        

            <br><br>
            <input id="checkbox" type="checkbox" />
            <label for="checkbox"> I agree that this purchase is non-refundable. I agree that I am responsible for confirming all final details and ensuring my travel documents are in order prior to boarding the flight. I also agree to these <a href="#">Terms and Conditions</a>.</label>
          </div>
          <!--
          <div class="info-box">
            <label for="children">CHILDREN</label>
            <select name="children" id="children">
              <option value="0">0</option>
              <option value="1">1</option>
              <option value="0">2</option>
              <option value="3">3</option>
            </select>
          </div>
            -->
          
      </div>
      
        <!-- SEARCH BUTTON -->
      <div id="flight-book">
        <div class="info-box">
          <input type="submit" id="book-flight" value="BOOK MY TRIP"/>
        </div>
      </div>
        
      </form> 
      </div>
    </section>
</div>

</html> 
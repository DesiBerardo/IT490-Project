<?php require(__DIR__."/nav.php"); ?>
<link rel="stylesheet" href="styles.css">

<div id="search-form">
    <div id="header">
      <h1>SEARCH FOR YOUR NEXT VACAY WITH ADDY</h1>
    </div>
    <section>
      <div class="flight" id="flightbox">
        
        <form id="flight-form" type="POST">
        <!-- TRIP TYPE -->
        <div id="flight-type">
          <div class="info-box">
            <input type="radio" name="flight-type" value="Return" id="return" checked />
            <label for="return">RETURN</label>
          </div>
          <div class="info-box">
            <input type="radio" name="flight-type" value="Single" id="one-way" />
            <label for="one-way">ONE WAY</label>
          </div>
        </div>
        
        <!-- FROM/TO -->
        <div id="flight-depart">
          <div class="info-box">
            <label for="">LEAVING FROM</label>
            <input type="text" id="dep-from" />
            <div id="depart-res"></div>
          </div>
          <div class="info-box" id="arrive-box">
            <label for="">ARRIVING AT</label>
            <input type="text" id="dep-to" />
            <div id="arrive-res"></div>
          </div>
        </div>
        
        <!-- FROM/TO -->
        <div id="flight-dates">
          <div class="info-box">
            <label for="">LEAVING ON</label>
            <input type="date" id="leave-date" min="<?= date('Y-m-d'); ?>" />
          </div>
          <div class="info-box" id="return-box">
            <label for="">RETURNING ON</label>
            <input type="date" id="return-date" />
          </div>
        </div>
        
        <!-- PASSENGER INFO -->
        <div id="flight-info">
          <div class="info-box">
            <label for="adults">ADULTS</label>
            <select name="adults" id="adults">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select>
          </div>
          <div class="info-box">
            <label for="children">CHILDREN</label>
            <select name="children" id="children">
              <option value="0">0</option>
              <option value="1">1</option>
              <option value="0">2</option>
              <option value="3">3</option>
            </select>
          </div>
          <div class="info-box">
            <label for="class-type">CLASS</label>
            <select name="class-type" id="class-type">
              <option value="Economy">ECONOMY</option>
              <option value="Business">BUSINESS</option>
              <option value="First">FIRST CLASS</option>
            </select>
          </div>
      </div>
      
        <!-- SEARCH BUTTON -->
      <div id="flight-search">
        <div class="info-box">
          <input type="submit" id="search-flight" value="SEARCH FLIGHTS"/>
        </div>
      </div>
        
      </form> 
      </div>
    </section>
  
    
      
</div>
<script>
    document.getElementById("flight-form").addEventListener("submit", login);

    function login(e) {
    e.preventDefault();
    console.log('caught!');

    // more code goes here...
    SendLoginRequest();
}
</script>

<?php
//echo "testing";
?>
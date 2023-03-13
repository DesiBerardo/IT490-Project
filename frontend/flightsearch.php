<?php require(__DIR__."/nav.php"); ?>
<link rel="stylesheet" href="styles.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


<script>

function HandleAPIResponse(response, origin, destination, classType)
{
    //api response was giving a random extra digit at the end of the response so I needed to slice it out
    //console.log(response);
    newresponse = response.slice(0,-1);
    response = JSON.parse(newresponse);
    console.log(response);

//	document.getElementById("textResponse").innerHTML = response+"<p>";	
	//document.getElementById("textResponse").innerHTML = "response: "+text+"<p>";
    
    //console.log("This is the server response: " +response);

    //building the results table

    document.getElementById("flight-results").innerHTML+= "<h2>Search Results</h2>";

    document.getElementById("flight-results").innerHTML+="Total Options Returned: "+response["meta"]["count"]+"<br><br>";
    for (let index = 0; index < response["meta"]["count"]; ++index){
        
        document.getElementById("flight-results").innerHTML+="\n\nOffer ID: " + response["data"][index]["id"];
        var cost = response["data"][index]["price"]["total"]+" "+response["data"][index]["price"]["currency"];
        document.getElementById("flight-results").innerHTML+=" Total Trip Cost: " + cost ;

        
        var table = document.createElement("table") ;
        document.getElementById("flight-results").appendChild(table);
        table.className="table";

        var orderArrayHeader = ["Segment", "Flight Number", "Departure Time", "Arrival Time"];
        var thead = document.createElement('thead');

        table.appendChild(thead);

        for (var i=0; i<orderArrayHeader.length; i++) {
            thead.appendChild(document.createElement("th")).
            appendChild(document.createTextNode(orderArrayHeader[i]));
        }

        
        for (let indexItin = 0; indexItin < response["data"][index]["itineraries"].length; ++indexItin){
          
            for (let indexSeg = 0; indexSeg < response["data"][index]["itineraries"][indexItin]["segments"].length; ++indexSeg){
                row = table.insertRow();
                table.appendChild(row);
                var cell = row.insertCell();
                var newText = document.createTextNode(response["data"][index]["itineraries"][indexItin]["segments"][indexSeg]["departure"]["iataCode"]+"-"+response["data"][index]["itineraries"][indexItin]["segments"][indexSeg]["arrival"]["iataCode"]);
                cell.appendChild(newText);

                var cell = row.insertCell();
                var carrier = response["data"][index]["itineraries"][indexItin]["segments"][indexSeg]["carrierCode"];
                var flightNumber = response["data"][index]["itineraries"][indexItin]["segments"][indexSeg]["number"];
                var newText = document.createTextNode(carrier+" "+flightNumber);
                cell.appendChild(newText);

                var cell = row.insertCell();
                var departTiming = response["data"][index]["itineraries"][indexItin]["segments"][indexSeg]["departure"]["at"]
                var newText = document.createTextNode(departTiming.slice(0,10)+" "+departTiming.slice(11,19));
                cell.appendChild(newText);

                var cell = row.insertCell();
                var arrivalTiming = response["data"][index]["itineraries"][indexItin]["segments"][indexSeg]["arrival"]["at"]
                var newText = document.createTextNode(arrivalTiming.slice(0,10)+" "+arrivalTiming.slice(11,19));
                cell.appendChild(newText);

                
                //var newText = document.createTextNode(arrivalTiming.slice(0,9)+" "+arrivalTiming.slice(11,19));
                //cell.appendChild(newText);

            }
            
            var arrStr = encodeURIComponent(JSON.stringify(response["data"][index]["itineraries"][indexItin]["segments"]));
            var duration = response["data"][index]["itineraries"][indexItin]["duration"].slice(2,response["data"][index]["itineraries"][indexItin]["duration"].length) ;
            var bookingLink = "/flightbooking.php?destination="+destination+"&origin="+origin+"&cost="+cost+"&duration="+duration+"&class="+classType+"&array="+arrStr;
            document.getElementById("flight-results").innerHTML+= '<a href="'+ bookingLink +'" >BOOK TRIP</a>'+"<br><br>";
          
        }
    }
}
    
    


function SendBackendRequest()
{   
    const form = document.getElementById('flight-form');
    var origin = String(form.elements["origin"].value);
    var destination = String(form.elements["destination"].value);
    var departDay = String(form.elements["dep-date"].value);
    var departTime = String(form.elements["dep-time"].value);
    var classType = String(form.elements["class-type"].value);

        
    console.log(origin, destination, departDay, departTime, classType);
    
    
	var request = new XMLHttpRequest();
	request.open("POST","apiflightsearch.php",true);
	request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	request.onreadystatechange= function()
	{
		
		if ((this.readyState == 4)&&(this.status == 200))
		{
            //console.log(this.responseText);

            HandleAPIResponse(this.responseText , origin, destination, classType);

		}
	}
	request.send("type=submit&origin="+origin+"&destination="+destination+"&depDay="+departDay+"&depTime="+departTime+"&class="+classType);
}
function sendLoginInfo() {
        //not in use currently, code shifted to sendloginrequest
        
        SendLoginRequest(username , password);
    }
</script>

<div id="search-form">
    <div id="header">
      <h1>SEARCH FOR YOUR NEXT VACAY WITH ADDY</h1>
    </div>
    <section>
      <div class="flight" id="flightbox">
        
        <form id="flight-form" type="POST">
        
        
        <!-- FROM/TO -->
        <div id="flight-depart">
          <div class="info-box">
            <label for="">Departing City IATA Code</label>
            <input type="text" id="origin" />
            <div id="depart-res"></div>
          </div>
          <div class="info-box" id="arrive-box">
            <label for="">Arriving City IATA Code</label>
            <input type="text" id="destination" />
            <div id="arrive-res"></div>
          </div>
        </div>
        
        <!-- FROM/TO -->
        <div id="flight-dates" >
          <div class="info-box" >
            <label for="" >LEAVING ON</label>
            <input type="date" id="dep-date" min="<?= date('Y-m-d'); ?>" />
            <input type="time" id="dep-time"/>
          </div>

          <div class="info-box" >
            <label for="">Please enter the full date and departure time in your local timezone including the AM/PM designation.</label>
          </div>
          
        </div>
        
        <!-- PASSENGER INFO -->
        <div id="flight-info">
          <div class="info-box">
            <label for="adults">Travelling Passengers</label>
            <select name="adults" id="adults">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select>
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

<div id="flight-results">
</div>
<script>
    document.getElementById("flight-form").addEventListener("submit", login);

    function login(e) {
    e.preventDefault();
    console.log('caught!');
     
    document.getElementById("flight-results").innerHTML= "";

    // more code goes here...
    SendBackendRequest();
}
</script>

<?php
//echo "testing";
?>
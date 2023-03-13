<?php require(__DIR__."/nav.php"); ?>
<link rel="stylesheet" href="styles.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


<script>

function HandleAPIResponse(response)
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

    document.getElementById("attractions-results").innerHTML+= "<h2>Search Results</h2>";

    document.getElementById("attractions-results").innerHTML+="Total Options Returned: "+response["data"].length+"<br><br>";
    for (let index = 0; index < response["data"].length; ++index){

        var table = document.createElement("table") ;
        document.getElementById("attractions-results").appendChild(table);
        table.className="table";

        var orderArrayHeader = ["Attraction", "More Information"];
        var thead = document.createElement('thead');
        table.appendChild(thead);

        for (var i=0; i<orderArrayHeader.length; i++) {
            thead.appendChild(document.createElement("th")).
            appendChild(document.createTextNode(orderArrayHeader[i]));
        }

        row = table.insertRow();
        table.appendChild(row);
        var cell = row.insertCell();
        var name = response["data"][index]["name"];
        var newText = document.createTextNode(name);
        //console.log(response["data"]["name"])
        cell.appendChild(newText);

        var cell = row.insertCell();
        var link = "https://www.google.com/search?q=" + name ;
        //onclick="window.open('+link+')" 
        cell.innerHTML= '<a href="'+ link +'" >Learn More</a>';
        //console.log(response["data"]["name"])
        //cell.appendChild(newText);
    }
    
}

    
    


function SendBackendRequest()
{   
    const form = document.getElementById('attractions-form');
    var cities = String(form.elements["cities"].value);
    var categories = String(form.elements["categories"].value);

        
    console.log(cities);
    
	var request = new XMLHttpRequest();
	request.open("POST","apiprefsearch.php",true);
	request.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	request.onreadystatechange= function()
	{
		
		if ((this.readyState == 4)&&(this.status == 200))
		{
            console.log(this.responseText);

            HandleAPIResponse(this.responseText);
		}
	}
	request.send("type=submit&city="+cities+"&categories="+categories);
}
function sendLoginInfo() {
        //not in use currently, code shifted to sendloginrequest
        
        //SendLoginRequest(username , password);
    }
</script>
<div id="search-form">
    <div id="header">
      <h1>SEARCH ATTRACTIONS BY YOUR PREFERENCE!</h1>
    </div>
    <section>
      <div class="attractions" id="attractionsbox">
        
        <form id="attractions-form" type="POST">
        
        <!-- FROM/TO 
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
        -->
        <!-- FROM/TO -->
        <div id="attractions-list" >
          <div class="info-box" >
            <label for="" >Destination Picker</label>
            <select name="cities" id="cities">
              <option value="London">London</option>
              <option value="Paris">Paris</option>
              <option value="New York">New York</option>
              <option value="Barcelona">Barcelona</option>
              <option value="Bangalore">Bangalore</option>
              <option value="Berlin">Berlin</option>
              <option value="Dallas">Dallas</option>
              <option value="San Francisco">San Francisco</option>
            </select>
          </div>

          <div class="info-box" >
            <label for="">Please select the destination you wish to see attractions for.</label>
            <label for="">The top results within each city center's geobox will be returned.</label>
          </div>
        </div>
      

        <!-- Category Search-->
        <div id="attractions-list" >
          <div class="info-box" >
            <label for="" >Destination Picker</label>
            <select id="categories" multiple style ="height:100px" >
                    <option value="SIGHTS">SIGHTS</option>
                    <option value="SHOPPING">SHOPPING</option>
                    <option value="NIGHTLIFE">NIGHTLIFE</option>
                    <option value="RESTAURANT"> RESTAURANTS</option>
            </select>
          </div>

          <div class="info-box" >
            <label for="">Please select your category of preference that you wish to see attractions for.</label>
            <label for="">You may rank more than one category by holding down CTRL/CMD and selecting multiple options.</label>
          </div>
        </div>
      
        <!-- SEARCH BUTTON -->
      <div id="attractions-search">
        <div class="info-box">
          <input type="submit" id="search-flight" value="SEARCH ATTRACTIONS"/>
        </div>
      </div>
      </form> 
      </div>
    </section>
</div>

<div id="attractions-results">
</div>
<script>
    document.getElementById("attractions-form").addEventListener("submit", login);

    function login(e) {
    e.preventDefault();
    console.log('caught!');

    document.getElementById("attractions-results").innerHTML= "";

    // more code goes here...
    SendBackendRequest();
}
</script>

<?php
//echo "testing";
?>
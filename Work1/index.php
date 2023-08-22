<?php
    
    include_once('config.php');
    
    if (isset($_GET["readingsCount"])){
      $data = $_GET["readingsCount"];
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      $readings_count = $_GET["readingsCount"];
    }
    // default readings count set to 20
    else {
      $readings_count = 20;
    }

    $last_reading = getLastReadings();
    $last_reading_temp = $last_reading["temp"];
    $last_reading_tur = $last_reading["tur"];
    $last_reading_ph = $last_reading["ph"];
    $last_reading_orp = $last_reading["orp"];
    $last_reading_ec = $last_reading["ec"];
    $last_reading_flow = $last_reading["flow"];
    $last_reading_time = $last_reading["logtime"];

    // Uncomment to set timezone to - 1 hour (you can change 1 to any number)
    $last_reading_time = date("Y-m-d H:i:s", strtotime("$last_reading_time + 0 hours"));
    // Uncomment to set timezone to + 7 hours (you can change 7 to any number)
    //$last_reading_time = date("Y-m-d H:i:s", strtotime("$last_reading_time + 7 hours"));

    $min_temp = minReading($readings_count, 'temp');
    $max_temp = maxReading($readings_count, 'temp');
    $avg_temp = avgReading($readings_count, 'temp');

    $min_tur = minReading($readings_count, 'tur');
    $max_tur = maxReading($readings_count, 'tur');
    $avg_tur = avgReading($readings_count, 'tur');

    $min_ph = minReading($readings_count, 'ph');
    $max_ph = maxReading($readings_count, 'ph');
    $avg_ph = avgReading($readings_count, 'ph');

    $min_orp = minReading($readings_count, 'orp');
    $max_orp = maxReading($readings_count, 'orp');
    $avg_orp = avgReading($readings_count, 'orp');

    $min_ec = minReading($readings_count, 'ec');
    $max_ec = maxReading($readings_count, 'ec');
    $avg_ec = avgReading($readings_count, 'ec');

    $min_flow = minReading($readings_count, 'flow');
    $max_flow = maxReading($readings_count, 'flow');
    $avg_flow = avgReading($readings_count, 'flow');
?>

<!DOCTYPE html>
<html>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <link rel="stylesheet" type="text/css" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
    <header class="header">
      <!--  <h1>📊 University of Ilorin </h1> <h2>Cloud-based Water Monitoring System</h2>  -->

      <h1>University of Ilorin</h1> <h2>Cloud-based Water Quality Management System</h2>
        <form method="get">
            <input type="number" name="readingsCount" min="1" placeholder="Number of readings (<?php echo $readings_count; ?>)">
            <input type="submit" value="UPDATE">
        </form>
    </header>
<body>
    <p>Last reading: <?php echo $last_reading_time; ?></p>

    <section class="content">
        

	    <div class="box gauge--1">
	    <h3>WATER TEMPERATURE</h3>
              <div class="mask">
			  <div class="semi-circle"></div>
			  <div class="semi-circle--mask"></div>
			</div>
		    <p style="font-size: 30px;" id="temp">--</p>
		    <table cellspacing="5" cellpadding="5">
		        <tr>
		            <th colspan="3">Temperature <?php echo $readings_count; ?> readings</th>
	            </tr>
		        <tr>
		            <td>Min</td>
                    <td>Max</td>
                    <td>Average</td>
                </tr>
                <tr>
                    <td><?php echo $min_temp['min_amount']; ?> &deg;C</td>
                    <td><?php echo $max_temp['max_amount']; ?> &deg;C</td>
                    <td><?php echo round($avg_temp['avg_amount'], 2); ?> &deg;C</td>
                </tr>
            </table>
        </div>

        <div class="box gauge--2">
            <h3>WATER TURBIDITY</h3>
            <div class="mask">
                <div class="semi-circle"></div>
                <div class="semi-circle--mask"></div>
            </div>
            <p style="font-size: 30px;" id="tur">--</p>
            <table cellspacing="5" cellpadding="5">
                <tr>
                    <th colspan="3">Turbidity <?php echo $readings_count; ?> readings</th>
                </tr>
                <tr>
                    <td>Min</td>
                    <td>Max</td>
                    <td>Average</td>
                </tr>
                <tr>
                    <td><?php echo $min_tur['min_amount']; ?> NTU</td>
                    <td><?php echo $max_tur['max_amount']; ?> NTU</td>
                    <td><?php echo round($avg_tur['avg_amount'], 2); ?> NTU</td>
                </tr>
            </table>
        </div>

        <div class="box gauge--3">
            <h3>WATER PH LEVEL</h3>
            <div class="mask">
                <div class="semi-circle"></div>
                <div class="semi-circle--mask"></div>
            </div>
            <p style="font-size: 30px;" id="ph">--</p>
            <table cellspacing="5" cellpadding="5">
                <tr>
                    <th colspan="3">PH Level <?php echo $readings_count; ?> readings</th>
                </tr>
                <tr>
                    <td>Min</td>
                    <td>Max</td>
                    <td>Average</td>
                </tr>
                <tr>
                    <td><?php echo $min_ph['min_amount']; ?> </td>
                    <td><?php echo $max_ph['max_amount']; ?> </td>
                    <td><?php echo round($avg_ph['avg_amount'], 2); ?> </td>
                </tr>
            </table>
        </div>

    </section>

    <style>
div.sys{
    outline: 1px solid green;
    outline-offset: 15px;
    margin: 20px;
 }

 div.graph{
    outline: 1px solid green;
    outline-offset: 15px;
    margin: 20px;
 }

 div.ch{
    outline: 1px solid blue;
    outline-offset: 15px;
    margin: 20px;
 }

 div.dtt{
    outline: 1px solid orange;
    outline-offset: 15px;
    margin: 20px;
 }

 div.dwn{
    outline: 1px solid green;
    outline-offset: 15px;
    margin: 25px;
 }

 div.del{
    outline: 1px solid red;
    outline-offset: 15px;
    margin: 20px;
 }

.header{text-align:center;}
.content{text-align:center;}
#setpowtxt{text-align:center;}

.pow {
padding: 5px 35px;
font-size: 24px;
text-align: center;
cursor: pointer;
outline: none;
color: #fff;
background-color: #04AA6D;
border: none;
border-radius: 15px;
box-shadow: 0 9px #999;
}

.pow:hover {background-color: #3e8e41}

.pow:active {
background-color: #3e8e41;
box-shadow: 0 5px #666;
transform: translateY(4px);
}

p{text-align:center;}
h3{text-align:center;}

</style>

    <section class="content">

        <div class="box gauge--4">
            <h3>WATER ORP</h3>
            <div class="mask">
                <div class="semi-circle"></div>
                <div class="semi-circle--mask"></div>
            </div>
            <p style="font-size: 30px;" id="orp">--</p>
            <table cellspacing="5" cellpadding="5">
                <tr>
                    <th colspan="3">ORP <?php echo $readings_count; ?> readings</th>
                </tr>
                <tr>
                    <td>Min</td>
                    <td>Max</td>
                    <td>Average</td>
                </tr>
                <tr>
                    <td><?php echo $min_orp['min_amount']; ?> mV</td>
                    <td><?php echo $max_orp['max_amount']; ?> mV</td>
                    <td><?php echo round($avg_orp['avg_amount'], 2); ?> mV</td>
                </tr>
            </table>
        </div>

        <div class="box gauge--5">
            <h3>WATER EC</h3>
            <div class="mask">
                <div class="semi-circle"></div>
                <div class="semi-circle--mask"></div>
            </div>
            <p style="font-size: 30px;" id="ec">--</p>
            <table cellspacing="5" cellpadding="5">
                <tr>
                    <th colspan="3">EC <?php echo $readings_count; ?> readings</th>
                </tr>
                <tr>
                    <td>Min</td>
                    <td>Max</td>
                    <td>Average</td>
                </tr>
                <tr>
                    <td><?php echo $min_tur['min_amount']; ?> µS/cm</td>
                    <td><?php echo $max_tur['max_amount']; ?> µS/cm</td>
                    <td><?php echo round($avg_tur['avg_amount'], 2); ?> µS/cm</td>
                </tr>
            </table>
        </div>

        <div class="box gauge--6">
            <h3>WATER TDS</h3>
            <div class="mask">
                <div class="semi-circle"></div>
                <div class="semi-circle--mask"></div>
            </div>
            <p style="font-size: 30px;" id="flow">--</p>
            <table cellspacing="5" cellpadding="5">
                <tr>
                    <th colspan="3">TDS <?php echo $readings_count; ?> readings</th>
                </tr>
                <tr>
                    <td>Min</td>
                    <td>Max</td>
                    <td>Average</td>
                </tr>
                <tr>
                    <td><?php echo $min_tur['min_amount']; ?> PPM</td>
                    <td><?php echo $max_tur['max_amount']; ?> PPM</td>
                    <td><?php echo round($avg_tur['avg_amount'], 2); ?> PPM</td>
                </tr>
            </table>
        </div>

    </section>

    <div class="dwn">

<h3><p style="color: green;">DOWNLOAD LOGGED DATA</p></h3>

<div class="btn-group">

<h3>csv File Format</h3>
    
  <button id="btn1" onclick="location.reload()" class="button">Refresh Page</button>
  <button id="btn2" onclick="location.href='act.php?st=s'" class="button">DOWNLOAD</button>

  <h3>Excel File Format</h3>

  <button id="btn1" onclick="location.reload()" class="button">Refresh Page</button>
  <button id="btn2" onclick="location.href='act.php?st=se'" class="button">DOWNLOAD</button>

</div>
</div>



<?php
    echo   '<h3>View Latest ' . $readings_count . ' Readings</h3>
            <table cellspacing="10" cellpadding="10" id="tableReadings">
                <tr>
                    <th>ID</th>
                    <th>Water Temperature (&deg;C)</th>
                    <th>Water Turbidity (NTU)</th>
                    <th>Water PH</th>
                    <th>Water ORP (mV)</th>
                    <th>Water EC (µS/cm)</th>
                    <th>Water TDS (PPM)</th>
                    <th>Timestamp</th>
                </tr>';

    $result = getAllReadings($readings_count);

        if ($result) {
        while ($row = $result->fetch_assoc()) {
            $row_id = $row["id"];
            $row_temp = $row["temp"];
            $row_tur = $row["tur"];
            $row_ph = $row["ph"];
            $row_orp = $row["orp"];
            $row_ec = $row["ec"];
            $row_flow = $row["flow"];
            $row_reading_time = $row["logtime"];
            // Uncomment to set timezone to - 1 hour (you can change 1 to any number)
            $row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time + 0 hours"));
            // Uncomment to set timezone to + 7 hours (you can change 7 to any number)
            //$row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time + 7 hours"));

            echo '<tr>
                    <td>' . $row_id . '</td>
                    <td>' . $row_temp . '</td>
                    <td>' . $row_tur . '</td>
                    <td>' . $row_ph . '</td>
                    <td>' . $row_orp . '</td>
                    <td>' . $row_ec . '</td>
                    <td>' . $row_flow . '</td>
                    <td>' . $row_reading_time . '</td>
                  </tr>';
        }
        echo '</table>';
        $result->free();
    }
?>

<div class="del">

<h3><p style="color: red;">ERASE LOGGED DATA</p></h3>

<div class="btn-group">
    
  <button id="btn1" onclick="location.reload()" class="button">Refresh Page</button>
  <button id="btn2" onclick="dels()" class="button">ERASE</button>
  
</div>
</div>

<script>

    var temp = <?php echo $last_reading_temp; ?>;
    var tur = <?php echo $last_reading_tur; ?>;
    var ph = <?php echo $last_reading_ph; ?>;
    var orp = <?php echo $last_reading_orp; ?>;
    var ec = <?php echo $last_reading_ec; ?>;
    var flow = <?php echo $last_reading_flow; ?>;

    setTemperature(temp);
    setTurbidity(tur);
    setPH(ph);
    setORP(orp);
    setEC(ec);
    setFlow(flow);

    function dels(){
        var c = confirm("ARE YOU SURE YOU WANT TO ERASE ALL LOGGED DATA?");
        if (c) {
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "act.php?st=d");
        xmlhttp.send();  
        }  
}

    function setTemperature(curVal){
    	//set range for Temperature in Celsius -5 Celsius to 38 Celsius
    	var minTemp = 0;
    	var maxTemp = 100;
        //set range for Temperature in Fahrenheit 23 Fahrenheit to 100 Fahrenheit
    	//var minTemp = 23;
    	//var maxTemp = 100;

    	var newVal = scaleValue(curVal, [minTemp, maxTemp], [0, 180]);
    	$('.gauge--1 .semi-circle--mask').attr({
    		style: '-webkit-transform: rotate(' + newVal + 'deg);' +
    		'-moz-transform: rotate(' + newVal + 'deg);' +
    		'transform: rotate(' + newVal + 'deg);'
    	});
    	$("#temp").text(curVal + ' ºC');
    }



    function setTurbidity(curVal){
    	//set range for Humidity percentage 0 % to 100 %
    	var minTur = 0;
    	var maxTur = 300;

    	var newVal = scaleValue(curVal, [minTur, maxTur], [0, 180]);
    	$('.gauge--2 .semi-circle--mask').attr({
    		style: '-webkit-transform: rotate(' + newVal + 'deg);' +
    		'-moz-transform: rotate(' + newVal + 'deg);' +
    		'transform: rotate(' + newVal + 'deg);'
    	});
    	$("#tur").text(curVal + ' NTU');
    }


    function setPH(curVal){
    	//set range for Humidity percentage 0 % to 100 %
    	var minPH = 0;
    	var maxPH = 14;

    	var newVal = scaleValue(curVal, [minPH, maxPH], [0, 180]);
    	$('.gauge--3 .semi-circle--mask').attr({
    		style: '-webkit-transform: rotate(' + newVal + 'deg);' +
    		'-moz-transform: rotate(' + newVal + 'deg);' +
    		'transform: rotate(' + newVal + 'deg);'
    	});
    	$("#ph").text(curVal + ' ');
    }


    function setORP(curVal){
    	//set range for Humidity percentage 0 % to 100 %
    	var minORP = 0;
    	var maxORP = 600;

    	var newVal = scaleValue(curVal, [minORP, maxORP], [0, 180]);
    	$('.gauge--4 .semi-circle--mask').attr({
    		style: '-webkit-transform: rotate(' + newVal + 'deg);' +
    		'-moz-transform: rotate(' + newVal + 'deg);' +
    		'transform: rotate(' + newVal + 'deg);'
    	});
    	$("#orp").text(curVal + ' mV');
    }

    function setEC(curVal){
    	//set range for Humidity percentage 0 % to 100 %
    	var minEC = 0;
    	var maxEC = 100;

    	var newVal = scaleValue(curVal, [minEC, maxEC], [0, 180]);
    	$('.gauge--5 .semi-circle--mask').attr({
    		style: '-webkit-transform: rotate(' + newVal + 'deg);' +
    		'-moz-transform: rotate(' + newVal + 'deg);' +
    		'transform: rotate(' + newVal + 'deg);'
    	});
    	$("#ec").text(curVal + ' µS/cm');
    }

    function setFlow(curVal){
    	//set range for Humidity percentage 0 % to 100 %
    	var minFlow = 0;
    	var maxFlow = 50;

    	var newVal = scaleValue(curVal, [minFlow, maxFlow], [0, 180]);
    	$('.gauge--6 .semi-circle--mask').attr({
    		style: '-webkit-transform: rotate(' + newVal + 'deg);' +
    		'-moz-transform: rotate(' + newVal + 'deg);' +
    		'transform: rotate(' + newVal + 'deg);'
    	});
    	$("#flow").text(curVal + ' PPM');
    }


    function scaleValue(value, from, to) {
        var scale = (to[1] - to[0]) / (from[1] - from[0]);
        var capped = Math.min(from[1], Math.max(from[0], value)) - from[0];
        return ~~(capped * scale + to[0]);
    }


</script>
</body>
</html>
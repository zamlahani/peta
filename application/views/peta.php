<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<title>Welcome to CodeIgniter</title>
	<link rel="stylesheet" href="https://peta.zamlahani.com/assets/leaflet/leaflet.css"/>
	<script src="https://peta.zamlahani.com/assets/leaflet/leaflet.js"></script>
	<style>
	    body {
    padding: 0;
    margin: 0;
}
html, body, #map {
    height: 100%;
    width: 100vw;
}
	</style>
</head>
<body>

<div id="container">
	<h1>Welcome to CodeIgniter!</h1>

	<div id="body">
	<div id="mapid" style="height:400px"></div>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>
<script>
var mymap = L.map('mapid').setView([51.505, -0.09], 10);
L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox.streets',
    accessToken: 'pk.eyJ1IjoiemFtbGFoYW5pIiwiYSI6ImNqbGcwN28zbTBndmszcHBrOGl5eHBidjQifQ.bsbdXVbvSlGQIewC9NFg_w'
}).addTo(mymap);
mymap.locate({watch:true});
mymap.on('click', function(e){
  var coord = e.latlng;
  var lat = coord.lat;
  var lng = coord.lng;
  console.log("You clicked the map at latitude: " + lat + " and longitude: " + lng+". Your location is: "+myLoc);
  console.log("Distance: "+e.latlng.distanceTo(myLoc));
  
  });
  var myLoc;
function onLocationFound(e) {
    var radius = e.accuracy / 2;

    L.marker(e.latlng).addTo(mymap)
        .bindPopup("You are within " + radius + " meters from this point").openPopup();

    L.circle(e.latlng, radius).addTo(mymap);
    myLoc=e.latlng;
}

mymap.on('locationfound', onLocationFound);
</script>
</body>
</html>
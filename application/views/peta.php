<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<title>Tes Peta</title>
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/leaflet/leaflet.css"/>
	<script src="<?php echo base_url() ?>assets/leaflet/leaflet.js"></script>
	<style>
	    body {
    padding: 0;
    margin: 0;
}
html, body, #map {
    height: 100%;
    width: 100vw;
font-family: Arial;
}
	</style>
</head>
<body>

<div id="container">
	<h1>Tes Peta</h1>
	<div>Silahkan tap suatu titik untuk mengetahui jaraknya. Batas = 3 titik.</div>
	<button id="reset">Reset</button>
	<div id="report"></div>
	<div id="body">
	<div id="mapid" style="height:400px"></div>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>
<script>
var myLoc,marker,circle,markers=[],dist,i;
var markerCount=0;
var report = document.getElementById("report");
var reset = document.getElementById("reset");
var mymap = L.map('mapid').setView([-7.24,112.73], 10);
L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox.streets',
    accessToken: 'pk.eyJ1IjoiemFtbGFoYW5pIiwiYSI6ImNqbGcwN28zbTBndmszcHBrOGl5eHBidjQifQ.bsbdXVbvSlGQIewC9NFg_w'
}).addTo(mymap);
mymap.locate();
mymap.on('click', function(e){
i=markers.length;
if(i<3){
  var coord = e.latlng;
  var lat = coord.lat;
  var lng = coord.lng;
  console.log(coord);
  dist=e.latlng.distanceTo(myLoc)/1000;
  markers[i]=L.marker(e.latlng);
  markers[i].addTo(mymap).bindPopup("Jarak: "+dist.toFixed(6)+" km.").openPopup();
  report.innerHTML="Lokasi Anda: "+myLoc+". Jarak: "+dist.toFixed(6)+" km.";
  }});
reset.addEventListener('click',function(e){
	for(i=0;i<markers.length;i++){
		markers[i].remove();
}
markers=[];
});
function onLocationFound(e) {
    var radius = e.accuracy / 2;
    if(marker){
        marker.remove();
    }
    marker = L.marker(e.latlng);
    marker.addTo(mymap).bindPopup("Anda berada di radius " + radius.toFixed(2) + " meter dari titik ini.").openPopup();
    if(circle){
        circle.remove();
    }
    circle=L.circle(e.latlng, radius);
    circle.addTo(mymap);
    myLoc=e.latlng;
}

mymap.on('locationfound', onLocationFound);
</script>
</body>
</html>

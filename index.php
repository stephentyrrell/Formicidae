<pre><?php
if (isset($_GET['start']) === false || isset($_GET['end']) === false) {
  die('Please be sure to set ?start=123%20Easy%20Street&end=321%20Up%20Yours in the URL');
}
$start = $_GET['start'];
$end   = $_GET['end'];
$directions_raw = json_decode(file_get_contents('http://maps.googleapis.com/maps/api/directions/json?origin=212%20Silverado%20Range%20View,%20Calgary,%20AB&destination=187%20Shawglen%20rd%20SW,%20Calgary,%20AB&sensor=false'));
$directions = $directions_raw->routes[0]->legs[0]->steps;
array_unshift($directions, (object) array('distance' => (object) array('value' => 0), 'start_location' => $directions_raw->routes[0]->legs[0]->start_location, 'end_location' => $directions_raw->routes[0]->legs[0]->start_location));
array_push($directions, (object) array('distance' => (object) array('value' => 0), 'start_location' => $directions_raw->routes[0]->legs[0]->end_location, 'end_location' => $directions_raw->routes[0]->legs[0]->end_location));
print_r($directions);
?>
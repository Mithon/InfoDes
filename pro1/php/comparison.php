<?php

echo('<head>' . '<link rel="stylesheet" href="../css/normalize.css">' . '<link rel="stylesheet" href="../css/skeleton.css">' . '</head>');
echo('<head>' . '<style>body {font-size: 30px} span {font-size: 0.6em; font-style: italic;} .minmax{font-size: 0.4em;} .name{font-size: 0.4em;}</style>' . '</head>');
echo('<h4>number,name,averageRating,minRating,maxRating</h4>');

$count = 0;
// Grabbing Neighbourhoods
$hoods = array();
$neighbourhoods = file_get_contents("../toronto-assaults.json");
$yelps = file_get_contents("../average-yelps.json");
$allHoods = json_decode($neighbourhoods);
$yelpScores = json_decode($yelps);
//print $allHoods->neighbourhoods[0]->Name;

foreach ($allHoods->neighbourhoods as $neigh) {
    echo('<h2><span>' . ($count+1) . ',' . $neigh->Name . '</span>');
    echo('<span class="name">Assaults</span>' . $neigh->perTenThousand . '<span class="name">Average-Yelp</span>' . $yelpScores->yelpScores[$count]->averageRating . '<br>');
    $count++;
}


//$hoods = array('Black Creek', 'Steeles', 'Forest Hill');
/**
 * User input is handled here
 */
$longopts  = array(
    "term::",
    "location::",
);

$options = getopt("", $longopts);

$term = $options['term'] = '';
$location = $options['location'] = 'Steeles';

//echo('<h1>' . $location . ': ' . $term . '</h1>');



foreach ($hoods as $hood) {

}

?>

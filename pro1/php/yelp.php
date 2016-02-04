<?php

/**
 * Yelp API v2.0 code sample.
 *
 * This program demonstrates the capability of the Yelp API version 2.0
 * by using the Search API to query for businesses by a search term and location,
 * and the Business API to query additional information about the top result
 * from the search query.
 *
 * Please refer to http://www.yelp.com/developers/documentation for the API documentation.
 *
 * This program requires a PHP OAuth2 library, which is included in this branch and can be
 * found here:
 *      http://oauth.googlecode.com/svn/code/php/
 *
 * Sample usage of the program:
 * `php sample.php --term="bars" --location="San Francisco, CA"`
 */

// Enter the path that the oauth library is in relation to the php file
require_once('lib/OAuth.php');

// Set your OAuth credentials here
// These credentials can be obtained from the 'Manage API Access' page in the
// developers documentation (http://www.yelp.com/developers)
$CONSUMER_KEY = 'dCp404BfNoNA2l6QxR7vfA';
$CONSUMER_SECRET = 'cMCWXtscKzk2sNsL6dAdQMnHbGI';
$TOKEN = 'fs-z0_Bn_WLGrBGLaCvPpEx0ggBcnvSF';
$TOKEN_SECRET = '0aFLarlnNMWLVESTKiZ0laU3rVQ';


$API_HOST = 'api.yelp.com';
$DEFAULT_TERM = 'lunch';
$DEFAULT_LOCATION = 'Toronto, ON';
$SEARCH_LIMIT = 20;
$SEARCH_PATH = '/v2/search/';
$BUSINESS_PATH = '/v2/business/';

/**
 * Makes a request to the Yelp API and returns the response
 *
 * @param    $host    The domain host of the API
 * @param    $path    The path of the APi after the domain
 * @return   The JSON response from the request
 */
function request($host, $path) {
    $unsigned_url = "https://" . $host . $path;

    // Token object built using the OAuth library
    $token = new OAuthToken($GLOBALS['TOKEN'], $GLOBALS['TOKEN_SECRET']);

    // Consumer object built using the OAuth library
    $consumer = new OAuthConsumer($GLOBALS['CONSUMER_KEY'], $GLOBALS['CONSUMER_SECRET']);

    // Yelp uses HMAC SHA1 encoding
    $signature_method = new OAuthSignatureMethod_HMAC_SHA1();

    $oauthrequest = OAuthRequest::from_consumer_and_token(
        $consumer,
        $token,
        'GET',
        $unsigned_url
    );

    // Sign the request
    $oauthrequest->sign_request($signature_method, $consumer, $token);

    // Get the signed URL
    $signed_url = $oauthrequest->to_url();

    // Send Yelp API Call
    $ch = curl_init($signed_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

/**
 * Query the Search API by a search term and location
 *
 * @param    $term        The search term passed to the API
 * @param    $location    The search location passed to the API
 * @return   The JSON response from the request
 */
function search($term, $location) {
    $url_params = array();

    $url_params['term'] = $term ?: $GLOBALS['DEFAULT_TERM'];
    $url_params['location'] = $location?: $GLOBALS['DEFAULT_LOCATION'];
    $url_params['limit'] = $GLOBALS['SEARCH_LIMIT'];
    $url_params['sort'] = 1;
    $search_path = $GLOBALS['SEARCH_PATH'] . "?" . http_build_query($url_params);

    return request($GLOBALS['API_HOST'], $search_path);
}

/**
 * Query the Business API by business_id
 *
 * @param    $business_id    The ID of the business to query
 * @return   The JSON response from the request
 */
function get_business($business_id) {
    $business_path = $GLOBALS['BUSINESS_PATH'] . $business_id;

    return request($GLOBALS['API_HOST'], $business_path);
}

/**
 * Queries the API by the input values from the user
 *
 * @param    $term        The search term to query
 * @param    $location    The location of the business to query
 */
function query_api($term, $location) {
    $response = json_decode(search($term, $location));
    $business_id = $response->businesses[0]->id;
    $ratings = array();
    $min = 20;
    $max = 0;
    $total = 0;


    foreach ( $response->businesses as $value)  {
        array_push($ratings, $value->rating);

        //print '<h1>' . $value->name . '</h1>';
        //print '<h1>' . $value->rating. '</h1>';
        //print get_business($value->id) . '<br><br>';
    }

    foreach ($ratings as $rating) {
        if ($rating > $max)
            $max = $rating;
        if ($rating < $min && $rating != 0) 
            $min = $rating;
        $total += $rating;

        //print $rating;
    }
    $average = $total / count($ratings);
    print ',' . $average . ',<span class="minmax">' . $min . ',' . $max . ',</span></h2>';

    /*
    print sprintf(
        "%d businesses found, querying business info for the top result \"%s\"\n\n",
        count($response->businesses),
        $business_id
    );

    $response = get_business($business_id);

    print sprintf("Result for business \"%s\" found:\n", $business_id);
    print "$response\n";
    */
}

echo('<head>' . '<link rel="stylesheet" href="../css/normalize.css">' . '<link rel="stylesheet" href="../css/skeleton.css">' . '</head>');
echo('<head>' . '<style>span {font-size: 0.6em; font-style: italic;} .minmax{font-size: 0.4em;}</style>' . '</head>');
echo('<h4>number,name,averageRating,minRating,maxRating</h4>');

$count = 1;
// Grabbing Neighbourhoods
$hoods = array();
$neighbourhoods = file_get_contents("../toronto-assaults.json");
$allHoods = json_decode($neighbourhoods);
//print $allHoods->neighbourhoods[0]->Name;

foreach ($allHoods->neighbourhoods as $neigh) {
    //print $neigh->Name;
    array_push($hoods, $neigh->Name);

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
    echo('<h2><span>' . $count. ',' . $hood . '</span>');
    query_api($term, $hood);
    $count++;
}

//query_api($term, $location);

?>

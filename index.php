<?php
/**
*   Functions 
*/

include('./functions.php');

/**
 * Routing
 */

define('URL','http://localhost:8888/red-list/');
define('token', '9bb4facb6d23f48efbf424bb05c0c1ef1cf6f468393bc745d42179ac4aca5fee');

//Get q param

$q = !empty($_GET['q']) ? strtolower($_GET['q']) : 'home';

//define controller
$controller = '404';

if($q == 'home'){
    $controller = 'home';
}

if ($q == 'map') {
    $controller = 'map';
}

if ($q == 'about') {
    $controller = 'about';
}

// Country

$countryNameURL = 'https://apiv3.iucnredlist.org/api/v3/country/list?token='.token;
$countryArray = ApiRequest($countryNameURL, 604800);

foreach ($countryArray->results as $key => $value) {
    // SPIECES
    if (preg_match('/^'.str_replace(" ", "_",strtolower($value->country)).'\/[a-z _.]+[\/]?$/', $q)) {
        $controller = 'species';
        $_GET['country'] = $value->isocode;
    }
    elseif (preg_match('/^'.str_replace(" ", "_",strtolower($value->country)).'[\/]?$/', $q)) {
        $controller = 'country';
        $_GET['country'] = $value->isocode;
    }
}




//include controller
include ('./controllers/'.$controller.'.php');
<?php
    /**
    *   API 
    */

    // SORT BY Value
    $sortBy = 'LC';

    if (!empty($_POST['speciesLeft'])) {
        $species = json_decode($_POST['speciesLeft']);
        // echo '<pre>';
        // print_r($species);
        // echo '</pre>';
        $selectedSpeciesArray = selectRandomSpiecies((array) $species, 6);
        foreach ($selectedSpeciesArray['newArray'] as $key => $value) {
            // Make URL
            $speciesInfosUrl='https://apiv3.iucnredlist.org/api/v3/species/'.$value['names'].'?token='.token;
            // Make Request
            $speciesInfosArray = ApiRequest($speciesInfosUrl, 604800);
            // Add Infos to general Array
            foreach ($speciesInfosArray->result[0] as $keySpecies => $value) {
                $selectedSpeciesArray['newArray'][$key][$keySpecies] = $value;
            }
        }
        $selectedSpeciesArray['newArray'] = addUrlImage($selectedSpeciesArray['newArray']);
        ?>
        <?php include('./views/partials/specy_tile.php'); ?>
        <?php
        echo "===SEPARATOR===";
        die(json_encode($selectedSpeciesArray));
    }


    // Change Sort if $_POST from the form on the page
    if (!empty($_POST['cat'])) {
        $sortBy = $_POST['cat'];
        $array = json_decode($_POST['current_array']);
        $array = (array) $array;

        $selectedSpeciesArray = selectRandomSpiecies((array)$array[$sortBy],6);
        foreach ($selectedSpeciesArray['newArray'] as $key => $value) {
            // Make URL
            $speciesInfosUrl='https://apiv3.iucnredlist.org/api/v3/species/'.$value['names'].'?token='.token;
            // Make Request
            $speciesInfosArray = ApiRequest($speciesInfosUrl, 604800);
            // Add Infos to general Array
            foreach ($speciesInfosArray->result[0] as $keySpecies => $value) {
                $selectedSpeciesArray['newArray'][$key][$keySpecies] = $value;
            }
        }
        $selectedSpeciesArray['newArray'] = addUrlImage($selectedSpeciesArray['newArray']);
        ?>
        <?php include('./views/partials/specy_tile.php'); ?>
        <?php
        echo "===SEPARATOR===";
        die(json_encode($selectedSpeciesArray));
    }

    // Get all URL

    $countryNameURL = 'https://apiv3.iucnredlist.org/api/v3/country/list?token=' . token;
    $countryArray   = ApiRequest($countryNameURL, 604800);


    $countrySpeciesURL = 'https://apiv3.iucnredlist.org/api/v3/country/getspecies/'.$_GET['country'].'?token='.token;
    $countryArray = ApiRequest($countrySpeciesURL, 604800);

    /**
    *   STATS VALUES 
    */

    $countSpecies = $countryArray->count;
    $categoryCountArray = array(
        'category' => array(
            'DD' => array(
                'count' => 0,
                'names' => array()
            ),
            'LC' => array(
                'count' => 0,
                'names' => array()
            ),
            'NT' => array(
                'count' => 0,
                'names' => array()
            ),
            'VU' => array(
                'count' => 0,
                'names' => array()
            ),
            'EN' => array(
                'count' => 0,
                'names' => array()
            ),
            'CR' => array(
                'count' => 0,
                'names' => array()
            ),
            'EW' => array(
                'count' => 0,
                'names' => array()
            ),
            'EX' => array(
                'count' => 0,
                'names' => array()
            ),
            'LR/lc' => array(
                'count' => 0,
                'names' => array()
            ),
            'LR/nt' => array(
                'count' => 0,
                'names' => array()
            ),
            'LR/cd' => array(
                'count' => 0,
                'names' => array()
            )
        ),
        'ratio' => array()
    );

    // Making Array Count
    foreach ($countryArray->result as $key => $value) {
        $categoryCountArray['category'][$value->category]['count']++;
        $categoryCountArray['category'][$value->category]['names'][]=$value->scientific_name;
    }

    // Making Stats
    foreach ($categoryCountArray['category'] as $key => $value) {
        $categoryCountArray['ratio'][$key] = $value['count']/$countSpecies;
    }

    // SORT BY VALUES

    $selectedSpeciesArray = selectRandomSpiecies($categoryCountArray['category'][$sortBy],6);

    /**
    *   Get Infos Of Species
    */
    foreach ($selectedSpeciesArray['newArray'] as $key => $value) {
        // Make URL
        $speciesInfosUrl='https://apiv3.iucnredlist.org/api/v3/species/'.$value['names'].'?token='.token;
        // Make Request
        $speciesInfosArray = ApiRequest($speciesInfosUrl, 604800);
        // Add Infos to general Array
        foreach ($speciesInfosArray->result[0] as $keySpecies => $value) {
            $selectedSpeciesArray['newArray'][$key][$keySpecies] = $value;
        }
    }


    /**
    *  Add Image URL
    */

    $selectedSpeciesArray['newArray'] = addUrlImage($selectedSpeciesArray['newArray']);

    // meta title

    $title = ucwords(str_replace('_',' ', $_GET['q']));
    // Include
    include('./views/pages/country.php');
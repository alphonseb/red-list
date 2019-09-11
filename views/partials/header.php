<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= !empty($title) ? $title : '' ?></title>
    <link rel="shortcut icon" href="<?= URL ?>dist/img/paw.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="<?= URL ?>dist/css/app.css">
</head>
<body>
<div class="loader-package">
    <img src="<?= URL ?>dist/img/paw.png" alt="logo-paw">
    <h3>Did you know ? Every year more than <br> two thousand species are scattered</h3>
    <div class="loader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
        </svg>
    </div>
</div>
<div class="async-loader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
    </svg>
</div>
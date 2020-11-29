<?php
include('data.php');

$apiResult = [];


if(isset($checkNumbers) || isset($checkStars)) {
    $apiResult = $checkedResults;
}

print json_encode($apiResult, JSON_PRETTY_PRINT);
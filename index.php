<?php
/**
 * Created by PhpStorm.
 * User: Koji
 * Date: 2018/04/07
 * Time: 18:27
 */

function test(string $input, $expect)
{
    list($fare, $passengerLabels) = explode(':', $input);

    $passengerLabelList = explode(',', $passengerLabels);
    $passengerList = [];
    $adultCount = $infantCount = 0;
    foreach ($passengerLabelList as $label) {
        $passenger = new Passenger($label);
        array_push($passengerList, $passenger);

        if (!$passenger->IsChild())
            $adultCount++;
        elseif ($passenger->IsInfant())
            $infantCount++;
    }

    echo 'fare: ' . $fare . "";
    echo ' p0: ' . $passengerLabels[0] . " p1: " . $passengerLabels[1];
    echo ' passengers: ' . $passengerLabels;
    echo ' expect: ' . $expect . "\n";
}


include_once "Passenger.php";
include_once "sample.php";

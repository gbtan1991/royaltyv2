<?php

function formatDateTime($dateTime) {
    return date('F j, Y, g:i A', strtotime($dateTime));
}

function formatGender($gender) {
    if ($gender == 'Male') {
        return 'M';
    } else {
        return 'F';
    }
}

function formatShortDate($dateTime) {
    return date('F j, Y', strtotime($dateTime)); 
}

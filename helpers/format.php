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


function formatHoursFromPoints($totalPoints) {
    $hours = floor($totalPoints / 2); // Each 2 points = 1 hour
    $minutes = ($totalPoints % 2) * 30; // Remaining points converted to minutes

    return sprintf("%d hr %d min", $hours, $minutes);
}

function formatRole($role){
    switch(strtolower($role)){
        case 'superadmin':
            return 'Super Administrator';
        case 'admin':
            return 'Administrator';
        default:
            return 'Unknown Role';
    }
}

function formatAdmin($admin){
    return ucfirst(htmlspecialchars(strtolower( trim($admin))));
}
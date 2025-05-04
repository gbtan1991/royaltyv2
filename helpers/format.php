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

function formatShorterDate($dateTime) {
    return date('m/d/Y', strtotime($dateTime)); 
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


function formatWeekRange($date = null){
    $startOfWeek = new DateTime();
    $startOfWeek->setISODate((int)date('Y'), (int)date('W'));
    $startOfWeek->modify('monday this week'); // Set to Monday of this week

    $endOfWeek = clone $startOfWeek;
    $endOfWeek->modify('sunday this week'); // Set to Sunday of this week

    // Return the date range in MM/DD format
    return [
        'startDate' => $startOfWeek->format('m/d'),  // MM/DD format
        'endDate' => $endOfWeek->format('m/d')      // MM/DD format
    ]; 


}
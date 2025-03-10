<?php

function formatDateTime($dateTime) {
    return date('F j, Y, g:i A', strtotime($dateTime));
}
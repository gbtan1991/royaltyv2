<?php


function randomGreeting(){
    $greetings = [
        "Hello, welcome back!",
        "Hi there, Lets get started!",
        "Greetings!",
        "Welcome Back! Let's get started.",
        "Hello! Ready to dive in?",
    ];
    return $greetings[array_rand($greetings)];
}
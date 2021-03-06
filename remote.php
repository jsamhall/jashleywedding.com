<?php
$guestName = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);
$favoriteSong = filter_input(INPUT_GET, 'song', FILTER_SANITIZE_STRING);
$mealChoiceAndMessage = filter_input(INPUT_GET, 'meal', FILTER_SANITIZE_STRING);

if(! strlen($guestName) || ! strlen($favoriteSong) || !strlen($mealChoiceAndMessage)){
    die(json_encode([
        'success' => false,
        'message' => 'Invalid or Missing Input'
    ]));
}

// The message
$message = "Guest Name(s): $guestName\r\n
Favorite Song: $favoriteSong\r\n
Meal Choice / Message: $mealChoiceAndMessage";

// In case any of our lines are larger than 70 characters, we should use wordwrap()
$message = wordwrap($message, 70, "\r\n");

// Send it
$result = mail('john@bagriders.com', 'Wedding RSVP Submission', $message);


echo json_encode([
    'success' => $result,
    'message' => $result ? "Sending mail succeeded!!" : "Sending mail failed :("
]);
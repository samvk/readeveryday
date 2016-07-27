<?php

error_reporting(0);

//Correct serve connection test
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit;
}

require "dbconnection.php";

$name = trim($_POST["name"]);
$email = trim($_POST["email"]);
$genre = trim($_POST["genre"]);
$message = trim($_POST["message"]);

//empty fields check (shouldn't be seen unless falsey value passed on purpose)
if (empty($name) || empty($email) || empty($message)) {
    echo "<p class='error'>Oops! You left some required fields blank.</p>";
    exit;
}

//Valid email check (shouldn't be seen unless falsey value passed on purpose)
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<p class='error'>Invalid email format.</p>";
    exit;
}

//Spam bot honeypot
if ($_POST["address"] !== "") {
    echo "<p class='error'>Bad form input.</p>";
    exit;
}

// Send message to database
$stmt = $db->prepare("INSERT INTO contact(name, email, genre, message) VALUES (:name, :email, :genre, :message)");
$stmt->execute(array(':name' => $name, ':email' => $email, ':genre' => $genre, ':message' => $message));

// Send message to email
$to = "skauffman@crec.org";
$email_subject = "New message from $name - \"Read Every Day\"";
$email_body = "You have received a new message from CREC's Read Every Day.\n\nHere are the details:\n\nName: $name\n\nEmail: $email_address\n\nFavorite Genre: $genre\n\nMessage:\n$message";
$headers = "From: noreply@crec.org/readeveryday\n";
$headers .= "Reply-To: $email_address";	

mail($to, $email_subject, $email_body, $headers);

echo "<p class='success'>Submitted!</p>";
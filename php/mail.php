<?php

error_reporting(0);

//Correct serve connection test
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit;
}

require "dbconnection.php";

$name = mysqli_real_escape_string($dbc, trim($_POST["name"]));
$email = mysqli_real_escape_string($dbc, trim($_POST["email"]));
$genre = mysqli_real_escape_string($dbc, trim($_POST["genre"]));
$message = mysqli_real_escape_string($dbc, trim($_POST["message"]));

//empty fields check (shouldn't be seen if html:required working)
if (empty($name) || empty($email) || empty($message)) {
    echo "<p class='error'>Oops! You left some required fields blank.</p>";
    exit;
}

//Valid email check (shouldn't be seen if html:required working)
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<p class='error'>Invalid email format.</p>";
    exit;
}

//Spam bot honeypot
if ($_POST["address"] != "") {
    echo "<p class='error'>Bad form input.</p>";
    exit;
}

// Send copy of message to database
mysqli_query($dbc, "INSERT INTO contact_form(name, email, genre, message) VALUES ('$name', '$email', '$genre', '$message')");

// Send message directly to crec email
$to = "skauffman@crec.org";
$email_subject = "New message from $name - \"Read Every Day\"";
$email_body = "You have received a new message from CREC's Read Every Day.\n\nHere are the details:\n\nName: $name\n\nEmail: $email_address\n\nFavorite Genre: $genre\n\nMessage:\n$message";
$headers = "From: noreply@crec.org/readeveryday\n";
$headers .= "Reply-To: $email_address";	

mail($to,$email_subject,$email_body,$headers);

echo "<p class='success'>Submitted!</p>";
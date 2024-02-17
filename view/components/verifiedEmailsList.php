<?php

require __DIR__ ."../../../vendor/autoload.php"; // Adjust the path based on your project structure

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

// Replace the path with the correct path to your Firebase Admin SDK JSON file
$factory = (new Factory)->withServiceAccount("../connections/firebaseConfig.json");
$auth = $factory->createAuth();

$email = 'promitbhattacharjee21@gmail.com';

try {
    $user = $auth->getUserByEmail($email);

    // Check if the user's email is verified
    $isEmailVerified = $user->emailVerified;

    if ($isEmailVerified) {
        echo "User's email is verified.";
    } else {
        echo "User's email is not verified.";
    }
} catch (\Kreait\Firebase\Exception\Auth\UserNotFound $e) {
    echo "User not found with email: $email";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}

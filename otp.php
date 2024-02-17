<?php
require __DIR__ . '/vendor/autoload.php';
use Kreait\Firebase\Factory;
use Kreait\Firebase\Value\PhoneNumber;
$factory = (new Factory)
    ->withServiceAccount('firebase.json');

$auth = $factory->createAuth();
$num="01798142951";
$signin =$auth->createUserWithEmailAndPassword();
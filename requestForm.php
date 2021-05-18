<?php
require 'rb.php';

$name = "";
$email = "";
$phone = "";
$address = "";
$typeOfEquipment = "";
$issue = "";
$create_date = "";

$name = isset($_POST['name']) ? clean($_POST['name']) : "";
$email = isset($_POST['email']) ? clean($_POST['email']) : "";
$phone = isset($_POST['phone']) ? clean($_POST['phone']) : "";
$address = isset($_POST['address']) ? clean($_POST['address']) : "";
$typeOfEquipment = isset($_POST['typeOfEquipment']) ? clean($_POST['typeOfEquipment']) : "";
$issue = isset($_POST['issue']) ? clean($_POST['issue']) : "";

date_default_timezone_set('Europe/Moscow');
$create_date = date("Y-m-d H:i:s");

R::setup( 'mysql:host=localhost;dbname=repair_bot_db', 'root', '' );

if(!R::testConnection()) die('error');

$requests = R::dispense('requests');
$requests->name = $name;
$requests->email = $email;
$requests->phone = $phone;
$requests->address = $address;
$requests->typeOfEquipment = $typeOfEquipment;
$requests->issue = $issue;
$requests->create_date = $create_date;

$id = R::store($requests);

echo "success";

exit;

function clean($value = "") {
    $value = trim($value);
    $value = stripslashes($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value);

    return $value;
}
?>
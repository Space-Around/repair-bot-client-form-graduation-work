<?php
require 'rb.php';

$name = "";
$email = "";
$phone = "";
$address = "";
$techName = "";
$issueDesc = "";
$create_date = "";

$name = isset($_POST['name']) ? clean($_POST['name']) : "";
$email = isset($_POST['email']) ? clean($_POST['email']) : "";
$phone = isset($_POST['phone']) ? clean($_POST['phone']) : "";
$address = isset($_POST['address']) ? clean($_POST['address']) : "";
$techName = isset($_POST['typeOfEquipment']) ? clean($_POST['typeOfEquipment']) : "";
$issueDesc = isset($_POST['issue']) ? clean($_POST['issue']) : "";

date_default_timezone_set('Europe/Moscow');
$create_date = date("Y-m-d H:i:s");

R::setup( 'mysql:host=localhost;dbname=repair_bot_db', 'root', '' );

if(!R::testConnection()) die('error');

$client = R::dispense('clients');
$client->name = $name;
$client->phone = $phone;
$client->email = $email;
$client->address = $address;

$client_id = R::store($client);

$issue = R::dispense('issues');
$issue->description = $issueDesc;

$issue_id = R::store($issue);

$tech = R::dispense('techs');
$tech->name = $techName;

$tech_id = R::store($tech);


$requests = R::dispense('requests');
$requests->client_id = $client_id;
$requests->tech_id = $tech_id;
$requests->issue_id = $issue_id;
$requests->create_date = $create_date;

$requests_id = R::store($requests);

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
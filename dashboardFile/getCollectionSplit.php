<?php
session_start();
include '../ajaxconfig.php';
include '../dashboardFile/collectionDashboardClass.php';

$user_id = $_SESSION['userid'];

$collectionClass = new collectionClass($user_id);

$response = $collectionClass->getCollectionSplit($con);

echo json_encode($response);
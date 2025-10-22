<?php

require_once 'Provision.php';

if (!isset($_POST['mac'])) {
	echo json_encode(['error' => 'MAC address is required']);
	exit;
}
if (!isset($_POST['location'])) {
	echo json_encode(['error' => 'Config ID is required']);
	exit;
}

try {
	$provision = new Provision($_POST['mac']);
	$provision->updateMapping($_POST['mac']??'', $_POST['location']??0);
	echo json_encode(['success' => 'Device mapped successfully']);
} catch (Exception $e) {
	echo json_encode(['error' => $e->getMessage()]);
	exit;
}


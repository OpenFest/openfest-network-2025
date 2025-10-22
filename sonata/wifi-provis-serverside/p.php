<?php

require_once 'Provision.php';

syslog(LOG_INFO, file_get_contents('php://input'));
$data = json_decode(file_get_contents('php://input'));
syslog(LOG_INFO, 'request_from = ' . $_SERVER['REMOTE_ADDR']);
syslog(LOG_INFO, 'data = ' . print_r($data, true));

syslog(LOG_INFO, 'Provisioning request for MAC: ' . ($data->mac ?? 'n/a'));
if (empty($data->mac)) {

	//return 404
	http_response_code(404);
	echo json_encode(['error' => 'MAC address is required']);
	exit;
}
try {
	$provision = new Provision($data->mac);
} catch (Exception $e) {
	http_response_code(500);
	echo json_encode(['error' => $e->getMessage()]);
	exit;
}
$configuration = $provision->provision();

if (empty($configuration)) {
	http_response_code(404);
	echo json_encode(['error' => 'No configuration found']);
	exit;
}

header('Content-Type: text/html');
syslog(LOG_INFO, 'Provisioned device with MAC: ' . $data->mac);
syslog(LOG_INFO, 'Configuration: ' . $configuration);
echo $configuration;

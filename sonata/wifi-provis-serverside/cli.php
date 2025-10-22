#!/usr/bin/php
<?php

require_once 'Provision.php';

$provision = new Provision();
$res = readline_completion_function(function($input, $index) {
	$commands = ['conf', 'dev', 'add-dev', 'add-conf', 'set', 'map', 'provision', 'exit', 'help', '?'];
	return array_filter($commands, function($command) use ($input) {
		return strpos($command, $input) === 0;
	});
});

//make command line interface, that can list all locations, provision a device, update a device location, and delete a device
while (true) {

	$choice = trim(readline("provision> "));
	switch ($choice) {
        case '':
            break;
		case 'conf':
			$configs = $provision->getConfig();
			echo '===== Configurations ====='.PHP_EOL;
			foreach ($configs as $location => $conf) {
				echo sprintf("Config ID: %2d, IP: %10s, CH2.4: %2d (PWR: %2d), CH5: %3d (PWR: %2d), Name: %s",
					$location,
					$conf['ip_addr'],
					$conf['wifi_channel_24'],
					$conf['power_24'],
					$conf['wifi_channel_5'],
					$conf['power_5'],
					$conf['name']).PHP_EOL;
			}
			break;
		case 'dev':
			$devices = $provision->getDevices();
			echo '===== Devices ====='.PHP_EOL;
			foreach ($devices as $mac => $type) {
				echo "MAC: $mac, Type: $type\n";
			}
			break;
		case 'add-dev':
			$mac = readline("Enter the MAC address: ");
			$type = readline("Enter the device type: ");
			$provision->addDevice($mac, $type);
			break;
			
        case 'add-conf':
            $id = readline("Enter the configuration location (ID): ");
            $name = readline("Enter the configuration name: ");
            $ip_addr = readline("Enter the IP address: ");
            $wifi_channel_24 = readline("Enter the 2.4GHz wifi channel: ");
            $wifi_channel_5 = readline("Enter the 5GHz wifi channel: ");
            $power_24 = readline("Enter the 2.4GHz power: ");
            $power_5 = readline("Enter the 5GHz power: ");
            
            $provision->addConfig((int) $id, $name, $ip_addr,  (int) $wifi_channel_24, (int) $wifi_channel_5, (int) $power_24, (int) $power_5);
            break;
		case 'set':
			$mac = readline("Enter the MAC address: ");
			$location = readline("Enter the location ID: ");
			$provision->updateMapping($mac, (int) $location);
			break;
		case 'map':
			$mappings = $provision->getMappings();
			echo '===== Mappings ====='.PHP_EOL;
			foreach ($mappings as $mac => $location) {
				echo "MAC: $mac, Location ID: $location\n";
			}
            break;
        case 'full-map':
            $fullMap = $provision->getFullMap();
            echo '===== Full Mappings ====='.PHP_EOL;
            foreach ($fullMap as $entry) {
                echo sprintf("MAC: %17s, Type: %10s, Location ID: %2d, Config: %s",
                                $entry['mac'],
                                $entry['type'],
                                $entry['location_id'] ?? 0,
                                isset($entry['configuration']) ? json_encode($entry['configuration']) : 'n/a'
                        ).PHP_EOL;
            }
            break;
		case 'provision':
			$mac = readline("Enter the MAC address: ");
			$location = readline("Enter the location ID (empty for autodetect): ");
			if (empty($location)) {
				$location = null;
			}
			$conf = $provision->provision($mac, $location);
			if (empty($conf)) {
				echo 'Failed to provision the device'.PHP_EOL;
				break;
			}
			echo 'Paste the following configuration to the device:'.PHP_EOL;
			echo '>>>>>>>>>'. PHP_EOL.PHP_EOL;
			echo $conf;
			echo PHP_EOL.'<<<<<<<<'.PHP_EOL;
			break;
		case '?':
		case 'help':
            echo 'Provisioning CLI'.PHP_EOL;
            echo 'Logs located at /var/log/syslog && /var/log/wifi-provisioning.log'.PHP_EOL;
			echo '===== Commands ====='.PHP_EOL;
			echo 'conf - List all locations'.PHP_EOL;
			echo 'dev - List all devices'.PHP_EOL;
			echo 'map - List all device locations'.PHP_EOL;
            echo 'full-map - List all devices with their locations and configurations'.PHP_EOL;
			echo 'add-dev - Add a device'.PHP_EOL;
			echo 'add-conf - Add a configuration'.PHP_EOL;
			echo 'provision - Provision a device - returns config to be used on the device'.PHP_EOL;
			echo 'set - Update a device location'.PHP_EOL;
			echo 'exit - Exit the program'.PHP_EOL;
			echo 'help / ? - Show this help'.PHP_EOL;
			break;
		case 'exit':
			exit;
		default:
			echo 'Invalid command'.PHP_EOL;
	}
}

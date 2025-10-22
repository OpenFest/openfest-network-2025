<?php
use Provision\Config;
use Provision\Device;

require_once 'Config.php';
require_once 'Device.php';


/**
 * Provision
 *
 * This class is responsible for provisioning WIFI devices.
 * We can use this class to provision a device, based on MAC address and
 * location ID.
 *
 * Once the parameters are passed, the class will provision the device and
 * return the configuration.
 *
 * @package Provision
 */
class Provision
{
	
	public static string $CONFIG_FILE = '/etc/wifi-provisioning/config.json';
	public static string $DEVICES_FILE = '/etc/wifi-provisioning/devices.json';
	protected static string $MAPPING_FILE = '/etc/wifi-provisioning/mapping.json';
	protected static string $LOG_FILE = '/var/log/wifi-provisioning.log';
	
	protected ?Config $config;
	protected ?Device $device;
	
	/**
	 * @throws Exception
	 */
	public function __construct(string $mac = NULL)
	{
		$this->device = $mac ? new Device($mac) : null;
		$this->config = null;
	}
	
	public function provision(string $mac=NULL, int $location=null)
	{
		if ($mac) {
			$this->device = new Device($mac);
		}
		if (!$this->device->check()) {
			$this->log('Device with MAC: ' . $this->device->getMac() . ' does not exist');
			return FALSE;
		}
		if ($location) {
			$this->config = new Config($location);
		}
		
		try {
			/** @var Config $configuration */
			$configuration = $this->getConfiguration();
		} catch (\Exception $e) {
			$this->log('Failed to provision device with MAC: ' . $this->device->getMac() . ' - ' . $e->getMessage());
			return false;
		}
		if (!$configuration) {
			$this->log('Failed to provision device with MAC: ' . $this->device->getMac());
			return false;
		}
		$this->log('Provisioned device with MAC: ' . $this->device->getMac());
		return $configuration->build($this->device->getType());
	}
	
	/**
	 * @throws Exception
	 */
	public function updateMapping(string $mac, int $locationID): bool
	{
		try{
			$device = new Device($mac);
		} catch (\Exception $e) {
			$this->log('Failed to update mapping for MAC: ' . $mac . ' - ' . $e->getMessage());
			return FALSE;
		}
		if (!$device->check()) {
			$this->log('Device with MAC: ' . $mac . ' does not exist');
			return false;
		}
		$mappings = $this->getMappings();
		$mappings[$mac] = $locationID;
		if (!file_put_contents(self::$MAPPING_FILE, json_encode($mappings))) {
			$this->log('Failed to update mapping for MAC: ' . $mac . ' and Config ID: ' . $locationID);
			return false;
		}
		$this->log('Updated mapping for MAC: ' . $mac . ' and Config ID: ' . $locationID);
		return true;
	}
	
	public function getMappings()
	{
		if (!file_exists(self::$MAPPING_FILE)) {
			file_put_contents(self::$MAPPING_FILE, json_encode([]));
		}
		
		$mappings = file_get_contents(self::$MAPPING_FILE);
		return json_decode($mappings, true);
	}
	
	public function getDevices()
	{
		if (!file_exists(self::$DEVICES_FILE)) {
			file_put_contents(self::$DEVICES_FILE, json_encode([]));
		}
		
		$devices = file_get_contents(self::$DEVICES_FILE);
		return json_decode($devices, true);
	}
	
	
	/**
	 * Get the configuration for the device
	 * @return array
	 */
	public function getConfig(): array
	{
		if (!file_exists(self::$CONFIG_FILE)) {
			file_put_contents(self::$CONFIG_FILE, json_encode([]));
		}
		
		$config = file_get_contents(self::$CONFIG_FILE);
		return json_decode($config, true);
	}

	public function getFullMap(): array
	{
		$devices = $this->getDevices();
		$mappings = $this->getMappings();
		$configs = $this->getConfig();

		$fullMap = [];
		foreach ($devices as $mac => $type) {
			$locationID = $mappings[$mac] ?? null;
			$configuration = $configs[$locationID] ?? null;
			$fullMap[] = [
				'mac' => $mac,
				'type' => $type,
				'location_id' => $locationID,
				'configuration' => $configuration
			];
		}
		return $fullMap;

	}
	
	/**
	 * Add a device to the provision devices file
	 * @return bool
	 */
	public function addDevice(string $mac, string $type): bool
	{
		try{
			$device = new Device($mac, $type);
		} catch (\Exception $e) {
			$this->log('Failed to add device with MAC: ' . $mac . ' - ' . $e->getMessage());
			return FALSE;
		}
		if ($device->check()) {
			$this->log('Device with MAC: ' . $device->getMac() . ' already exists');
			return FALSE;
		}
		if (!$device->save()) {
			$this->log('Failed to add device with MAC: ' . $device->getMac());
			return FALSE;
		}
		$this->log('Device with MAC: ' . $device->getMac() . ' added successfully');
		return TRUE;
	}
	
	public function addConfig(int $id, string $name, string $ip_addr,  int $wifi_channel_24, int $wifi_channel_5, int $power_24, int $power_5):
	bool
	{
		try{
			$config = new Config($id, $name, $ip_addr, $wifi_channel_24, $wifi_channel_5, $power_24, $power_5);
		} catch (\Exception $e) {
			$this->log('Failed to add configuration with ID: ' . $id . ' - ' . $e->getMessage());
			return FALSE;
		}

		if (!$config->save()) {
			$this->log('Failed to add configuration with ID: ' . $config->getId());
			return FALSE;
		}
		$this->log('Configuration with ID: ' . $config->getId() . ' added successfully');
		return TRUE;
	}
	
	private function log(string $message)
	{
		$now = date('Y-m-d H:i:s');
		$msgWithTs = "[$now] $message";
		file_put_contents(self::$LOG_FILE, $msgWithTs . PHP_EOL, FILE_APPEND);
		syslog(LOG_DEBUG, $message);
		if (php_sapi_name() === 'cli') {
			echo $message . PHP_EOL;
		}
	}
	
	private function getConfiguration(): ?Config
	{
		
		//detect configuration based on mac and location
		$mappings = $this->getMappings();
		$location = $mappings[$this->device->getMac()] ?? null;
		if (!$location) {
			$this->log('No mapping found for MAC: ' . $this->device->getMac());
			return null;
		}
		
		$config = $this->getConfig();
		$configuration = $config[$location] ?? null;
		if (!$configuration) {
			$this->log('No configuration found for location ID: ' . $location);
			return null;
		}
		
		$this->log('Configuration found for MAC: ' . $this->device->getMac() . ' and location ID: ' . $location);
		return new Config($location, $configuration['name'], $configuration['ip_addr'], $configuration['wifi_channel_24'], $configuration['wifi_channel_5'], $configuration['power_24'], $configuration['power_5']);
	}
}
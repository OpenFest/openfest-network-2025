<?php
namespace Provision;

use Provision;
class Device
{

	public static $DEVICE_TYPES = ['DAP', 'AP121'];
	
	protected ?string $mac;
	protected ?string $type;
	public function __construct($mac, $type = null)
	{
		//validate mac
		if (!filter_var($mac, FILTER_VALIDATE_MAC)) {
			throw new \Exception('Invalid MAC address');
		}
		$this->mac = $mac;
		
		if ($type && !in_array($type, self::$DEVICE_TYPES)) {
			throw new \Exception('Invalid device type. Possible values are: ' . implode(', ', self::$DEVICE_TYPES));
		}
		$this->type = $type ?? $this->getDeviceType();
		syslog(LOG_INFO, "New device created with MAC: $mac and type: $type");
	}
	
	/**
	 * Save the device to the provision devices file
	 * @return bool
	 */
	public function save(): bool
	{
		//save the device to the provision devices file
		if (!file_exists(Provision::$DEVICES_FILE)) {
			file_put_contents(Provision::$DEVICES_FILE, json_encode([]));
		}
		
		$devices = file_get_contents(Provision::$DEVICES_FILE);
		$devices = json_decode($devices, true);
		$devices[$this->mac] = $this->type;
		if (!file_put_contents(Provision::$DEVICES_FILE, json_encode($devices))) {
			return false;
		}
		return true;
		
	}
	
	/**
	 * Check if the device exists in the provision devices file
	 * @return bool
	 */
	public function check(): bool
	{
		//check if the device exists in the provision devices file
		$devices = file_get_contents(Provision::$DEVICES_FILE);
		$devices = json_decode($devices, true);
		
		return isset($devices[$this->mac]);
	}
	
	public function getDeviceType()
	{
		//get the device type from the provision devices file
		$devices = file_get_contents(Provision::$DEVICES_FILE);
		$devices = json_decode($devices, true);
		if (isset($devices[$this->mac])) {
			return $devices[$this->mac];
		}
		return null;
	}
	
	public function getMac(): ?string
	{
		return $this->mac;
	}
	
	public function getType(): ?string
	{
		return $this->type;
	}
	
	public function setMac($mac): void
	{
		$this->mac = $mac;
	}
	
	public function setType($type): void
	{
		$this->type = $type;
	}
}
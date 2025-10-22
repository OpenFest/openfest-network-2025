<?php
namespace Provision;
use Provision;

class Config
{
	
	protected ?int $id;
	protected ?string $name;
	protected ?string $ip_addr;
	protected ?int $wifi_channel_24;
	protected ?int $wifi_channel_5;
	protected ?int $power_24;
	protected ?int $power_5;
	
	public function __construct($id, $name = null, $ip_addr = null, $wifi_channel_24 = null, $wifi_channel_5 = null, $power_24 = null, $power_5 = null)
	{
		$this->id = $id;
		$this->setName($name);
		$this->setIpAddr($ip_addr);
		$this->setWifiChannel24($wifi_channel_24);
		$this->setWifiChannel5($wifi_channel_5);
		$this->setPower24($power_24);
		$this->setPower5($power_5);
		
	}
	
	public function build($type): false|string
	{
		$template = $this->detectTemplate($type);
		$template = str_replace('{{name}}', $this->name, $template);
		$template = str_replace('{{ip_addr}}', $this->ip_addr, $template);
		$template = str_replace('{{wifi_channel_24}}', $this->wifi_channel_24, $template);
		$template = str_replace('{{wifi_channel_5}}', $this->wifi_channel_5, $template);
		$template = str_replace('{{power_24}}', $this->power_24, $template);
		$template = str_replace('{{power_5}}', $this->power_5, $template);
		$template = str_replace('{{number}}', sprintf('%02d', $this->id), $template);
		
		
		return $template;
		
	}
	
	/**
	 * Set the configuration name
	 * @param string $name
	 */
	public function detectTemplate($type): false|string
	{
		//detect the template based on the device type
		if ($type == 'DAP') {
			return file_get_contents('/etc/wifi-provisioning/templates/DAP_TEMPLATE');
		}
		if ($type == 'AP121') {
			return file_get_contents('/etc/wifi-provisioning/templates/AP121_TEMPLATE');
		}
		
		return false;
		
	}
	
	public function setName(string $name)
	{
		//null or regex [a-zA-Z0-9_-]
		if (!is_null($name) && !preg_match('/^[a-zA-Z0-9_-]+$/', $name)) {
			throw new \Exception('Invalid name');
		}
		$this->name = $name;
	}
	
	public function setIpAddr(string $ip_addr)
	{
		//null or single ip address
		if (!is_null($ip_addr) && !filter_var($ip_addr, FILTER_VALIDATE_IP)) {
			throw new \Exception('Invalid IP address');
		}
		$this->ip_addr = $ip_addr;
	}
	

	
	public function setWifiChannel24(int $wifi_channel_24)
	{
		$this->wifi_channel_24 = $wifi_channel_24;
	}
	
	public function setWifiChannel5(int $wifi_channel_5)
	{
		//validate wifi channel ranges {52..64}{100..140} step 4
		if ($wifi_channel_5 < 52 || $wifi_channel_5 > 140 || ($wifi_channel_5 > 64 && $wifi_channel_5 < 100) || $wifi_channel_5 % 4 != 0) {
			throw new \Exception('Invalid 5GHz wifi channel');
		}
		$this->wifi_channel_5 = $wifi_channel_5;
	}
	
	public function setPower24(int $power_24)
	{
		//validate power ranges {1..20}
		if ($power_24 < 1 || $power_24 > 20) {
			throw new \Exception('Invalid 2.4GHz power');
		}
		$this->power_24 = $power_24;
	}
	
	public function setPower5(int $power_5)
	{
		//validate power ranges {1..22}
		if ($power_5 < 1 || $power_5 > 22) {
			throw new \Exception('Invalid 5GHz power');
		}
		$this->power_5 = $power_5;
	}
	
	public function getId(): ?int
	{
		return $this->id;
	}
	
	public function getName(): ?string
	{
		return $this->name;
	}
	
	public function getIpAddr(): ?string
	{
		return $this->ip_addr;
	}
	

	public function getWifiChannel24(): ?int
	{
		return $this->wifi_channel_24;
	}
	
	public function getWifiChannel5(): ?int
	{
		return $this->wifi_channel_5;
	}
	
	public function getPower24(): ?int
	{
		return $this->power_24;
	}
	
	public function getPower5(): ?int
	{
		return $this->power_5;
	}
	
	public function load()
	{
		//load the configuration from the provision configurations file
		$configs = file_get_contents(Provision::$CONFIG_FILE);
		$configs = json_decode($configs, true);
		if (isset($configs[$this->id])) {
			$this->name = $configs[$this->id]['name'];
			$this->ip_addr = $configs[$this->id]['ip_addr'];
			$this->wifi_channel_24 = $configs[$this->id]['wifi_channel_24'];
			$this->wifi_channel_5 = $configs[$this->id]['wifi_channel_5'];
		}
	}
	
	public function save(): bool
	{
		//save the configuration to the provision configurations file
		if (!file_exists(Provision::$CONFIG_FILE)) {
			file_put_contents(Provision::$CONFIG_FILE, json_encode([]));
		}
		
		$configs = file_get_contents(Provision::$CONFIG_FILE);
		$configs = json_decode($configs, true);
		$configs[$this->id] = [
			'name' => $this->name,
			'ip_addr' => $this->ip_addr,
			'wifi_channel_24' => $this->wifi_channel_24,
			'wifi_channel_5' => $this->wifi_channel_5
		];
		if (!file_put_contents(Provision::$CONFIG_FILE, json_encode($configs))) {
			return false;
		}
		return true;
	}
}

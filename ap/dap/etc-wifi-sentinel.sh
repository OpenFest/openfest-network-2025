#!/bin/ash

# Configuration
device="eth0.20"
target_ip="8.8.8.8"
interfaces="phy0-ap0 phy1-ap0"
mac=$(cat /sys/class/net/$device/address)	
ip_address=$(ip -4 addr show "$device" | awk '/inet / {print $2}' | cut -d/ -f1)
interval=59

check_ping() {
    logger -t wifi_sentinel_$mac_$ip_address "Pinging $target_ip"
    ping -c 1 -W 3 "$target_ip" >/dev/null 2>&1
    return $? 
}

wifi_down() {
    logger -t wifi_sentinel_$mac_$ip_address "No response from $target_ip, bringing WiFi interfaces down..."
    for interface in $interfaces; do
	ip link set "$interface" down
    done
}

wifi_up() {
    logger -t wifi_sentinel_$mac_$ip_address "Response from $target_ip detected, starting WiFi interfaces..."
    for interface in $interfaces; do
	ip link set "$interface" up
    done
}

# Main loop
wifi_is_down=0  

while true; do
    if check_ping; then
        if [ "$wifi_is_down" -eq 1 ]; then
            wifi_up
            wifi_is_down=0
        fi
    else
        if [ "$wifi_is_down" -eq 0 ]; then
            wifi_down
            wifi_is_down=1
        fi
    fi
    sleep "$interval"
done


!TL-SG2210MP
#
vlan 10
#
vlan 20
        name "of-mgmt"
#
vlan 30
        name "video-a"
#
vlan 31
        name "video-b"
#
vlan 40
        name "overflow"
#
vlan 50
        name "of-ap"
#
vlan 60
        name "of-voip"
#
vlan 70
 name "of-wired"                       quit)
#
vlan 80
        name "wifi"
#
vlan 95
        name "of-pos"
#
#
#
#
#
#
#
#
#
#
#
#
#
#
#
#
#                                     
#
#
#
#
hostname "sw-floor0"
#
#
system-time ntp UTC+08:00 133.100.9.2 139.78.100.163 12 199.165.76.11 140.142.16.34 128.138.140.44 
no system-time dst
#
#
#
user name admin privilege admin password @pass@
user name root privilege admin secret @pass@
enable password @pass@
no service reset-disable
#
#
#
#
#
#
#                                     
#
#
snmp-server
snmp-server community "@pass@" read-only "viewDefault"
#
#
lldp
#
#
#
power inline consumption 150.0
#
#
#
#
loopback-detection
#                                     
#
no controller cloud-based
no controller cloud-based privacy-policy
interface vlan 1
  ip address-alloc dhcp
  no ipv6 enable
#
interface vlan 20
  ip address 10.20.0.30 255.255.255.0
  no ipv6 enable
#
interface gigabitEthernet 1/0/1
  switchport general allowed vlan 10,20,30-31,40,60,70,80,95 tagged
  
#
interface gigabitEthernet 1/0/2
  switchport general allowed vlan 70 untagged
  switchport pvid 70
  
#
interface gigabitEthernet 1/0/3
  switchport general allowed vlan 10,20,30-31,40,60,70,80,95 tagged
                                      
#
interface gigabitEthernet 1/0/4
  switchport general allowed vlan 1,10,20,30-31,40,60,70,80,95 tagged
  switchport pvid 20
  
#
interface gigabitEthernet 1/0/5
  switchport general allowed vlan 1,10,20,30-31,40,60,70,80,95 tagged
  
#
interface gigabitEthernet 1/0/6
  switchport general allowed vlan 1,10,20,30-31,40,60,70,80,95 tagged
  
#
interface gigabitEthernet 1/0/7
  switchport general allowed vlan 1,10,20,30-31,40,60,70,80,95 tagged
  
#
interface gigabitEthernet 1/0/8
  switchport general allowed vlan 10,20,30-31,40,50,60,70,80,95 tagged
  switchport pvid 20
  
  power inline supply disable         
#
interface gigabitEthernet 1/0/9
  switchport general allowed vlan 10,20,30-31,40,50,60,70,80,95 tagged
  switchport pvid 20
  
#
interface gigabitEthernet 1/0/10
  switchport general allowed vlan 10,20,30-31,40,60,70,80,95 tagged
  
#
end


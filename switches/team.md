!TL-SG3210
#
vlan 20,60,70,80,207,666,999
#
vlan 20
name "of-mgmt"
#
vlan 60
name "of-voip"
#
vlan 70
name "of-wired"
#
vlan 80
name "of-wifi"
#
vlan 666
name "dh666"
#
#
#
#
hostname "sw-team"
#
mac address-table aging-time 300      
#                                     
logging buffer 6                      
no logging file flash                 
logging host index 1 10.20.0.1 6
#
enable secret @pass@
service password-encryption
#
system-time ntp UTC+02:00 10.20.0.1 10.20.0.1 4
#
spanning-tree mode rstp
#
#
user name admin privilege admin secret @pass@
user name root privilege admin secret @pass@
#
#
no ip http server
#
#
#
#
#
snmp-server
snmp-server community "@pass@" read-only "viewDefault"
#
interface gigabitEthernet 1/0/1       
  switchport access vlan 60
  description "phone-team"
#
interface gigabitEthernet 1/0/2
  switchport mode trunk
  switchport trunk allowed vlan 20,60,70,80,207,999
  description "ap"
#
interface gigabitEthernet 1/0/3
  switchport access vlan 70
  description "team-1/0/2"
#
interface gigabitEthernet 1/0/4
  switchport access vlan 70
  description "team-1/0/2"
#
interface gigabitEthernet 1/0/5
  switchport access vlan 70
  description "team-1/0/2"
#
interface gigabitEthernet 1/0/6
  switchport access vlan 70
  description "team-1/0/2"
#                                     
interface gigabitEthernet 1/0/7
  switchport access vlan 70
  description "team-1/0/2"
#
interface gigabitEthernet 1/0/8
  switchport mode trunk
  switchport trunk allowed vlan 20,60,70,80,207,666,999
  switchport pvid 70
  description "uplink/coresw"
#
interface gigabitEthernet 1/0/9
  speed 1000
  duplex full
#
interface gigabitEthernet 1/0/10
  switchport mode trunk
  switchport trunk allowed vlan 20,60,70,207,999
  description "uplink/coresw"
  speed 1000
  duplex full
#
ip management-vlan 20
interface vlan 20
ip address 10.20.0.21 255.255.255.0 10.20.0.1
#
#
line vty 0 15
password @pass@
login
#
end



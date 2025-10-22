!TL-SG3210
#
vlan 10,20,31,60
#
vlan 20
name "of-mgmt"
#
vlan 31
name "of-voc-b"
#
vlan 60
name "of-voip"
#
#
#
#
hostname "sw-voc-b"
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
  description "phone-voc-b"
#
interface gigabitEthernet 1/0/2
  switchport access vlan 31
  description "voc-b-1/0/2"
#
interface gigabitEthernet 1/0/3       
  switchport access vlan 31
  description "voc-b-1/0/2"
#
interface gigabitEthernet 1/0/4
  switchport access vlan 31
  description "voc-b-1/0/2"
#
interface gigabitEthernet 1/0/5
  switchport access vlan 31
  description "voc-b-1/0/2"
#
interface gigabitEthernet 1/0/6
  switchport access vlan 31
  description "voc-b-1/0/2"
#
interface gigabitEthernet 1/0/7
  switchport access vlan 31
  description "voc-b-1/0/2"
#
interface gigabitEthernet 1/0/8
  switchport access vlan 31
  description "voc-b-1/0/2"
#
interface gigabitEthernet 1/0/9       
  speed 1000
  duplex full
#
interface gigabitEthernet 1/0/10
  switchport mode trunk
  switchport trunk allowed vlan 10,20,31,60
  description "uplink/coresw"
  speed 1000
  duplex full
#
ip management-vlan 20
interface vlan 20
ip address 10.20.0.14 255.255.255.0 10.20.0.1
#
#
line vty 0 15
password @pass@
login
#
end

